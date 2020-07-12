<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Presence;
use App\Round;
use App\User;
Use App\Ranking;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        
        if(settings()->get('games') == 1)
        {
            $games = Game::where('white', $user)->orWhere('black', $user)->get();
        }
        else
        {
            $games = Game::all();
            
        }
        $users = User::all();
        $rounds = Round::all();
        $round_to_process = Round::where('processed', NULL)->first();
        if($round_to_process == NULL){
            $round_to_process = new Round;
            $round_to_process->id = 1;
        }
        
        $ranking = Ranking::orderBy('score', 'desc')->orderBy('value', 'desc')->get();
        
        $scores = $this->GetScore($games, $user, $round_to_process->id);
        
        return view('games.index')->with('rounds', $rounds)->with('ranking', $ranking)->with('games', $games)->with('users', $users)->with('current_user', $user)->with('scores', $scores)->with('round_to_process', $round_to_process);
    }

    public function GetScore($games, $user, $round)
    {
        
        $scores = Array();
        foreach($games as $game)
        {
            if($game->white == $user && $game->result == "Afwezigheid")
            {
                $white_score = 0;

                $white_ranking = Ranking::where('user_id', $game->white)->first();
                if($white_ranking == NULL)
                {
                    $white_score = 0;
                }
                else{
                if($game->black == "Club"){
                    
                    if($game->round < $round)
                    {
                        $white_score += 0.6667 * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += 0.6667 * $white_ranking->value;
                    }
                }
                elseif($game->black == "Personal"){
                    if($game->round < $round)
                    {
                        $white_score += 0.3333 * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += 0.3333 * $white_ranking->value;
                    }
                }
                else{
                    if($game->round < $round)
                    {
                        $white_score += 0.25 * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += 0.25 * $white_ranking->value;
                    }
                }
            }
                array_push($scores, ["score"=>$white_score, "game"=>$game->id]);
            }
            if(($game->white == $user && $game->result != "Afwezigheid") || ($game->black == $user && $game->result != "Afwezigheid"))
            {
                $result = explode("-", $game->result);
                $white_result = $result[0];
                $black_result = $result[1];
            
                // Find white and black in the ranking
                $white_ranking = Ranking::where('user_id', $game->white)->first();
                $black_ranking = Ranking::where('user_id', $game->black)->first();
            
                // Defaults; //69.05
                $white_score = 0;
                if($game->black == "Bye")
                {
                
                }
                else
                {
                    $black_score = 0;
                }
                // Calculate the new score for white and black for this game or all games?
                if($game->black == "Bye")
                {   
                    if($game->round < $round)
                    {
                        $white_score += 0.999 * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += 0.999 * $white_ranking->value;
                    }
                    $white_score += 0.05;
                }
                elseif($white_result == 1)
                {
                    if($game->round < $round)
                    {
                        $white_score += $white_result * $black_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += $white_result * $black_ranking->value;
                    }
                    $white_score += 0.05;
                    $black_score += 0.05;
                }
                elseif($white_result == 0.5)
                {   //69.05 += 0.5 * 69 = 69.05 + 34.5 = 103.60
                    if($game->round < $round)
                    {
                        $white_score += $white_result * $black_ranking->LastValue;
                        $black_score += $black_result * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score += $white_result * $black_ranking->value;
                        $black_score += $black_result * $white_ranking->value;
                    }
                    $white_score += 0.05;
                    $black_score += 0.05;
                }
                elseif($black_result == 1)
                {
                    if($game->round < $round)
                    {
                        $black_score += $black_result * $white_ranking->LastValue;
                    }
                    else
                    {
                        $black_score += $black_result * $white_ranking->value;
                    }
                    $black_score += 0.05;
                    $white_score += 0.05;
                }
                else // No result yet?
                {
                    continue;
                }
                
                if($game->white == $user)
                {
                    array_push($scores, ["score"=>$white_score, "game"=>$game->id]);
                }
                elseif($game->black == $user)
                {
                    array_push($scores, ["score"=>$white_score, "game"=>$game->id]);   
                }
                else
                {} 
            }
            else
            {
                
            }
        }
        return $scores;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        $game = Game::find($id);
        return view('games.edit')->with('game', $game);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $game = Game::find($id);
            
                $game->result = $request->input('result');
                
            if($game->save())
            {
                return redirect('Admin')->with('success', 'Aanwezigheid is aangepast');
            }
            else
            {
                return redirect('Admin')->with('error', 'Dit is niet jouw aanwezigheid die jij probeert aan te passen!');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
