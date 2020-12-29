<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Round;
use App\Models\Game;
use App\Models\Presence;
use App\Models\User;
use App\Models\Config;
use App\Models\Settings;

class Dashboard extends Component
{
   
    //public $announcement = Config::select('announcement')->first();
   public $rounds_to_search;
   
   public function __construct()
   {
       $this->rounds_to_search = $this->RoundDashBoard();
   }
    public function render()
    {
        $games = $this->GameDashBoard();
        $rounds = $this->rounds_to_search;
        $presences = $this->PresenceDashBoard();
        $absences = $this->AbsenceDashBoard();
        $users = User::all();
        $announcement = Config::select('announcement')->first();
    
        if($rounds == "Geen rondes meer!"){
            return view('livewire.dashboard',
            [
                'rounds' => $rounds,
                'config' => $announcement,
            ]);
        }
        return view('livewire.dashboard',
            [
                'rounds' => $rounds,
                'games' => $games,
                'presences' => $presences,
                'absences' => $absences,
                'users' => $users,
                'config' => $announcement,
            ]);
    }

    public function GameDashBoard()
    {
        
        if($this->rounds_to_search == "Geen rondes meer!")
        {
            $game_data = "Geen";
        }
        else{
            foreach($this->rounds_to_search as $round)
            {
                $game_data = Game::where([['round_id', '=', $round->round], ['result', '!=', 'Afwezigheid']])->get();
            }
        }
        return $game_data;
    }

    public function AbsenceDashBoard()
    {
    
        if($this->rounds_to_search == "Geen rondes meer!")
        {
            $absence_data = "Geen";
        }
        else{
            foreach($this->rounds_to_search as $round)
            {
                $absence_data = Game::where([['round_id', '=', $round->round], ['result', '=', 'Afwezigheid']])->get();
            }
        }
        return $absence_data;
    }
    public function RoundDashBoard()
    {
        $round_data = Round::where('date', '=', date('Y-m-d'))->orWhere('date', '>', date('Y-m-d'))->limit(1)->get();
        if($round_data->isEmpty())
        {
            $round_data = "Geen rondes meer!";
        }
        return $round_data;
    }

    public function PresenceDashBoard()
    {
        
        if($this->rounds_to_search == "Geen rondes meer!")
        {
            $presence_data = "Geen";
        }
        else{
            foreach($this->rounds_to_search as $round)
            {
                $presence_data = Presence::where([['round', '=', $round->round], ['presence', '=', '1']])->get();
            }
        }
        return $presence_data;
    }
}
