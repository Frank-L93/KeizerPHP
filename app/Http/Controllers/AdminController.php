<?php

namespace App\Http\Controllers;


use App\Http\Controllers\PushController;
use Illuminate\Http\Request;
use App\Presence;
use App\Round;
use App\User;
Use App\Ranking;
Use App\Game;
use App\Match;
use App\Config;
use App\Settings;
use App\Calculation;
use App\TPRHelper;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\iOSNotificationsController;
use Carbon\Carbon;

global $k;
class AdminController extends Controller
{
    
    // Index page of our Admin
    public function admin()
    {   
        $games = Game::all();
        $users = User::all();
        $presences = Presence::all();
        $rounds = Round::all();
        $configs = Config::all();
        $round_to_process = Round::where('processed', NULL)->orWhere('processed', 0)->first();
        if($round_to_process == NULL){
            $round_to_process = new Round;
            $round_to_process->id = 0;
        }
        $ranking = Ranking::orderBy('score', 'desc')->orderBy('value', 'desc')->get();
        return view('admin.index')->with('rounds', $rounds)->with('presences', $presences)->with('ranking', $ranking)->with('games', $games)->with('users', $users)->with('round_to_process', $round_to_process)->with('configs', $configs);
    }


    // Round functionallity of our Admin
    public function RoundsCreate()
    {
        $round = Round::all();
        return view('rounds.create')->with('rounds', $round);
    }

    public function RoundStore(Request $request)
    {
        $this->validate($request,[
            'round' => 'required',
            'date' => 'required'
        ]);

        $round = new Round;
        $round->round = $request->input('round');
        $round_exist = Round::where('round', $round->round)->get();
        if($round_exist->isEmpty())
        {   
            $round->date = $request->input('date');
            $round->save();
        }
        else
        {
                return redirect('/Admin')->with('error', 'Deze ronde is al aangemaakt!');
        }
        return redirect('/Admin')->with('success', 'Ronde aangemaakt!');
    }

    // Presences functionallity of our Admin

    public function DestroyPresences($id)
    {
        if(Gate::allows('admin', Auth::user())){
            $presence = Presence::find($id);
            $presence->delete();
            return redirect('/Admin')->with('success', 'Aanwezigheid verwijderd!');
        }
        else
        {
            return redirect('/presences')->with('error', 'Je hebt geen toegang tot administrator-paginas!');
        }
    }

    public function DestroyRounds($id)
    {
        if(Gate::allows('admin', Auth::user())){
            $round = Round::find($id);
            $round->delete();
            return redirect('/Admin')->with('success', 'Rondeverwijderd!');
        }
        else
        {
            return redirect('/rounds')->with('error', 'Je hebt geen toegang tot administrator-paginas!');
        }
    }

    // Games Functionallity of our Admin

    public function DestroyGames($id)
    {
        if(Gate::allows('admin', Auth::user())){
            $game = Game::find($id);
            $game->delete();
            return redirect('/Admin')->with('success', 'Partij verwijderd!');
        }
        else
        {
            return redirect('/games')->with('error', 'Je hebt geen toegang tot administrator-paginas!');
        }
    }

    // Starting Matching process --> This you want somewehre else, but I dont know where. #help
    
    public function FillArrayPlayers($round) // loads all players that are needed to be paired in the specified round.
    {
        $players = Array();
        $lower_value_set = 0;
        $presentPlayers = Presence::select('user_id')->where(['round' => $round, 'presence' => '1'])->get();
        foreach($presentPlayers as $player)
        {
            $lowest_value_set = 0;
            array_push($players, $player->user_id);
            $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();
            if($lowest_value == NULL)
            {
                $lowest_value_set = Config::InitRanking('start');
            }
            $player_ranked = Ranking::where('user_id', $player->user_id)->get();
            // Player needs to be in Ranking, so add him if he does not appear there yet.
            if($player_ranked->isEmpty())
            {
                $ranking = new Ranking;
                $ranking->user_id = $player->user_id;
                $ranking->score = 0;
                if($lowest_value_set ==  Config::InitRanking('start'))
                {
                    $ranking->value = $lowest_value_set;
                }
                else
                {
                    $ranking->value = $lowest_value->value - 1;
                }
                $ranking->save();
            }
        }
        // We now have all players, before matching, this needs to be sorted.
        return $this->FillArrayPlayersRanked($players, $round);
    }

    public function checkPaired($player, $round){
      
        $paired_white = Game::where(['white' => $player, 'round_id'=> $round])->get();
        $paired_black = Game::where(['black' => $player, 'round_id'=> $round])->get();
        
        if($paired_white->isEmpty() && $paired_black->isEmpty())
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    private function sort_value($a, $b)
    {
        return strnatcmp($b['value'], $a['value']);
    }
    public function FillArrayPlayersRanked($players, $round) // Fills an array of players to be paired together with their rank rank ? sorted ?
    {
        $playerswithranking = Array();
        foreach($players as $player)
        {
            $player = Ranking::where('user_id', $player)->first();
            $check_already_paired = $this->checkPaired($player->user_id, $round);
            // In weird cases players may already be paired (i.e. new pairings?) so check it.
            if($check_already_paired == true)
            {

            }
            else
            {
                $player_array = ["id" => $player->user_id, "rank" => $player->id, "value" => $player->value];
                array_push($playerswithranking, $player_array);
            }
        }
        usort($playerswithranking, array($this, 'sort_value')); // Sorting on value.
       
        $matches = new Match();
        $matches->InitPairing($playerswithranking, $round); // Launch Pairing!
        return redirect('/Admin')->with('Success', 'Partijen aangemaakt!'); // Return will most likely not be called as in the pairing process, the last return that can be called is the return for the notifications which afterwards redirects to the Admin-page too. But for cases that this does not happen, this return is necessary.
    }

    // Helping function for UpdateGame, returns a json to fill editable list.
    public function List()
    {
        $users = User::all();
        $user_list = Array();
        foreach($users as $user)
        {
            array_push($user_list, ["value" => $user->id, "text"=>$user->name]);
        } 
        return json_encode($user_list);
    }
   
    // Game Changing functionality of our Admin

    public function UpdateGame(request $request)
    {
        
        $game = Game::find($request->input('pk'));
            if($request->input('name') == 'result')
            {
                $game->result = $request->input('value');
            }
            elseif($request->input('name') == 'white')
            {
                $game->white = $request->input('value');
            }
            elseif($request->input('name') == 'black')
            {   
                $game->black = $request->input('value');
            }
            else{

            }
        return $game->save();
    }

    // User update functionality of the Admin
    public function UpdateUser(request $request){
     
        $user = User::find($request->input('pk'));
        if($request->input('name') == 'email')
        {
            $user->email = $request->input('value');
        }
        elseif($request->input('name') == 'rights')
        {
            $user->rechten = $request->input('value');
        }
        elseif($request->input('name') == 'rating')
        {
            $user->rating = $request->input('value');
        }
        elseif($request->input('name') == 'active')
        {
            $user->active = $request->input('value');
        }
        elseif($request->input('name') == 'knsb_id')
        {
            $user->knsb_id = $request->input('value');
        }
        elseif($request->input('name') == 'beschikbaar')
        {
            $user->beschikbaar = $request->input('value');
        }
        else{
            return redirect('/Admin')->with('error', 'Je wilde niks aanpassen. Wat doe je hier?');
        }
        return $user->save();
    }

    // Destroy a user
    public function DestroyUser($id)
    {
        if(Gate::allows('admin', Auth::user())){
            $presences = Presence::where('user_id', $id)->get();
            foreach($presences as $presence)
            {
                $presence->delete();
            }
            $games = Game::where('white', $id)->orWhere('black', $id)->get();
            foreach($games as $game)
            {
                if($game->white == $id)
                {
                    $game->white == "Lid verwijderd";
                }
                else
                {
                    $game->black == "Lid verwijderd";
                }
                $game->save();
            }
            $user= User::findorFail($id);
            $user->delete();
            return redirect('/Admin')->with('success', 'Gebruiker verwijderd!');
        }
        else
        {
            return redirect('/')->with('error', 'Je hebt geen toegang tot administrator-paginas!');
        }
    }

    
    // New Season
    public function ResetSeason()
    {
        // Write results to file
        // Empty season tables
        DB::statement("SET foreign_key_checks=0");
        Ranking::truncate();
        Round::truncate();
        Presence::truncate();
        Game::truncate();  
        $configs = Config::find(1);
        $configs->EndSeason = 0;
        $configs->save();
        DB::statement("SET foreign_key_checks=1");
        return redirect('/Admin')->with('success', 'Seizoen gereset');
    }

    // Presences
    public function InitPresences()
    {
        $users = User::where('beschikbaar', 1)->get();
        $rounds = Round::all();
        foreach($users as $user)
        {
            foreach($rounds as $round)
            {
                $presence_exist = Presence::where([['user_id', '=', $user->id],['round','=', $round->round]])->get();
             
               if($presence_exist->isEmpty())
               {
                $presence = new Presence;
                $presence->user_id = $user->id;
                $presence->round = $round->round;
                $presence->presence = 1;
                $presence->save();
               }
                
            }
        }
        return redirect('/Admin')->with('success', 'Aanwezigheden aangemaakt');
    }

    // Calculation
    public function InitCalculation($round)
    {
        $calculation = new Calculation;
        $calculation->Calculate($round);
        // No return necessary, return happens in Class of Calculation. But in case this fails, return to /Admin with a success message.
        return redirect('/Admin')->with('success', 'Ranglijst is bijgewerkt.');
    }

    // Ranking functionality of our Admin
    public function InitRanking()
    {
        $users = User::where('beschikbaar', 1)->orderBy('rating', 'desc')->get();
        $i = Config::InitRanking("start");
        foreach($users as $user)
        {
            $ranking_exist = Ranking::where('user_id', $user->id)->get();
            if($ranking_exist->isEmpty())
            {
                $ranking = new Ranking;
                $ranking->user_id = $user->id;
                $ranking->score = 0;
                $ranking->value = $i;
                $ranking->save();
                $i = $i - Config::InitRanking("step");
            }
        }
        return redirect('/Admin')->with('success', 'Ranglijst aangemaakt');
    }

    // Rating List functionality of our Admin ??
    public function RatingList()
    {
        return view('admin.ratinglist');
    }

    public function Config(Request $request)
    {
        $configs = Config::find(1);
        $configs->RoundsBetween_Bye = $request->input('RoundsBetween_Bye');
        $configs->RoundsBetween = $request->input('RoundsBetween');
        $configs->Name = $request->input('Name');
        $configs->Season = $request->input('Season');
        $configs->Club = $request->input('Club');
        $configs->Personal = $request->input('Personal');
        $configs->Presence = $request->input('Presence');
        $configs->Start = $request->input('Start');
        $configs->Step = $request->input('Step');
        $configs->Other = $request->input('Other');
        $configs->Bye = $request->input('Bye');
        $configs->EndSeason = $request->input('EndSeason');
        //$configs->Admin = $request->input('Admin');
        $configs->save();
        return redirect('/Admin')->with('success', 'Instellingen aangepast!');
    }
    
    // Process the upload of the Rating List and generate user for player in case of non-existence.
    public function loadRatings(Request $request)
    {
        

            $file = $request->file('csv_file');
            
      
            // File Details 
            $filename = $file->getClientOriginalName();
            
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
      
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
      
              // Check file size
              if($fileSize <= $maxFileSize){
      
               
                
      
                // Reading file
                $file = fopen($file,"r");
      
                $importData_arr = array();
                
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                     
                   }
                   $i++;
                }
                fclose($file);
            
               
                foreach($importData_arr as $importData){
                    
                    $insertData = array(
                       "knsb_id"=>$importData[0],
                       "name"=>$importData[1],
                       "email"=>$importData[2],
                       "rating"=>$importData[3],
                    "beschikbaar"=>$importData[4]);
                
                    // Check if KNSB_ID exist, then it is necessary to update, but no need to change password.
                    // Otherwise create.
                    $exist = User::where('knsb_id', $insertData['knsb_id'])->get();
                    if($exist->isEmpty()){
                        // Create so pass password and name. Settings are set when logged in for first time. 
                        User::updateOrCreate(['knsb_id' => $insertData['knsb_id'],
                        
                    ],
                        [
                        'name' => htmlspecialchars($insertData['name']),
                        'email' => $insertData['email'],
                        'password' => Hash::make($insertData['knsb_id']),
                        'rating' => $insertData['rating'],
                        'beschikbaar' => $insertData['beschikbaar'],
                        'activate' => 0,
                        ]
                    );
                    User::where('knsb_id', $insertData['knsb_id'])->update(['settings' => ["notifications"=>"0"]]);
                    User::where('knsb_id', $insertData['knsb_id'])->update(['api_token' => Str::random(10)]);
                    }
                    else{
                        // Update so don't pass name and password, but update email! // Still use updateOrCreate function though because it easier.
                        User::updateOrCreate(['knsb_id' => $insertData['knsb_id'],
                    ],
                        [
                            'email' => $insertData['email'],
                            'rating' => $insertData['rating'],
                            'beschikbaar'=>$insertData['beschikbaar'],
                            'activate' => 0,
                            
                        ]);
                   User::where('knsb_id', $insertData['knsb_id'])->update(['settings' => ["notifications"=>"0"]]);
                   User::where('knsb_id', $insertData['knsb_id'])->update(['api_token' => Str::random(10)]);
                    }
                  
                }
                return redirect('/Admin')->with('success', 'Ratinglijst is verwerkt!');
            }
        }
    
    }
    
    // Process of file for Rounds (fields round and date)
    public function loadRounds(Request $request)
    {
        

            $file = $request->file('csv_file');
            
      
            // File Details 
            $filename = $file->getClientOriginalName();
            
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
      
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
      
              // Check file size
              if($fileSize <= $maxFileSize){
      
               
                
      
                // Reading file
                $file = fopen($file,"r");
      
                $importData_arr = array();
                
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                     
                   }
                   $i++;
                }
                fclose($file);
            
               
                foreach($importData_arr as $importData){
                    
                    $insertData = array(
                       "round"=>$importData[0],
                       "date"=>$importData[1]
                       );
                
                    // Update or Create (so if the round exists, it will update the date of the round)
                    // Otherwise it will create a new round.
                        Round::updateOrCreate(['round' => $insertData['round'],
                    ],
                        [
                            'date' => $insertData['date'],
                            
                            
                        ]);
                   
                  
                }
                return redirect('/Admin')->with('success', 'Rondes zijn succesvol verwerkt!');
            }
        }
    
    }
}

