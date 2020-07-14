<?php

namespace App;
Use App\Round;
Use App\Game;
Use App\Ranking;
Use App\Config;
use App\Http\Controllers\PushController;

class Match
{
   
    public function InitPairing($players, $round)
    {
       $playerstopair = $players;
       $round = $round;
       $init = 0;
       
       
       //Check even or odd amount of players
       if(count($playerstopair) % 2 == 0)
       {
        $bye_necessary = 0;
       }else{
           $bye_necessary = 1;
       }
        $this->MatchGame($playerstopair, $round, $bye_necessary);
       
    }
    
    public function MatchGame($playerstopair, $round, $bye_necessary) // matches players
    {
        $matches = Array();
        $matched = Array();
      
        if($bye_necessary == 1){
            Bye:
            $bye = rand(0, count($playerstopair));
            if(count($playerstopair) == 1){
                $bye = 0;
            }
            if($this->validBye($playerstopair[$bye], $round) == true)
            {
                $this->createGame($playerstopair[$bye]["id"], "Bye", $round);
                array_push($matched, $playerstopair[$bye]["id"]);
            }
            else{
                goto Bye;
            }
        }
      
        foreach($playerstopair as $playertopair)
        {
            $player_being_paired = $playertopair["id"];
            if(in_array($player_being_paired, $matched) == false)
            {
                // Player is not yet paired, so find an available opponent:
                // Preferred opponent is next in $playerstopair, or the most closest one that is a valid opponent.
                // Valid opponent is a player that is not yet paired and a player who has not played against our player being paired in the last X rounds.
                // Also the color should be checked (if both are on -2 or +2 they can't play against eachother, if one is on -2 or + 2, and the other is on -1 or +1, it is possible, giving the player with the -2 / +2 the correct color)
                foreach($playerstopair as $opponent)
                {
                    $opponent_being_paired = $opponent["id"];
                    if($opponent == $playertopair || (in_array($opponent_being_paired, $matched) == true))
                    {
                        // Just skip this one as the opponent is the player being paired or the opponent being paired is already paired.
                    }
                    else
                    {
                        // Opponent is not paired yet, and opponent is not or player being paired
                        // Check if Opponent is valid for this Player.
                        if($this->validOpponent($player_being_paired, $opponent_being_paired, $round, count($matched), count($playerstopair)) == true)
                        {
                            // if Valid, create Game.
                            if($this->createGame($player_being_paired, $opponent_being_paired, $round) == true)
                            {
                                array_push($matched, $opponent_being_paired); // Add opponent to Matched Players
                                array_push($matched, $player_being_paired); // Add Player to Matched Players
                                break;
                            }
                            else{
                                return redirect('/Admin')->with('Error', 'Fout bij aanmaken van partij!');                            }
                        }
                    }
                }
            }
            else{
                // Not necessary to pair
            }
        }
        if(count($matched) == count($playerstopair))
        {
            // Create notification
            $b = new iOSNotificationsController();
            $b->newFeedItem('Partijen', 'Partijen voor ronde'.$round.' zijn aangemaakt!', 'https://interndepion.nl/games', '2');
             $a = new PushController();
            $a->push('Admin', 'Partijen voor ronde '.$round.' zijn aangemaakt!', 'Partijen', '2');
            return redirect('/Admin')->with('success', 'Partijen voor ronde '.$round.' aangemaakt');
        }
        else
        {
            return redirect('/Admin')->with('error', 'Partijen aangemaakt voor ronde '.$round.' maar foutief');
        }
    }

    public function validBye($player_one, $round){
        $round_minimum = $round - Config::RoundsBetween(1);
        if($round_minimum < 0)
        {
            $round_minimum = 1;
        }
        $game_exist = Game::where([['white', '=', $player_one], ['black', '=', 'Bye']])->whereBetween('round_id', [$round_minimum, $round])->get();
        if(($game_exist->isNotEmpty()))
        {
            return false;
        }
        // If valid return True;
        return true;
    }
    public function validOpponent($player_one, $player_two, $round, $amount_matched, $amount_to_match){
        if($amount_to_match - $amount_matched < 3)
        {
            return true;
        }
        // Not valid when:
        // Both players have -2 or +2
        $color_value = Ranking::where('user_id', $player_one)->first();
        $color = $color_value->color;

        $color_value_black = Ranking::where('user_id', $player_two)->first();
        $color_black = $color_value_black->color;
        if(($color == "-2" && $color_black == "-2") || ($color == "2" && $color_black == "2"))
        {
            return false;
        }
        // Not valid when:
        // Players have played against eachother in last X rounds.
        $round_minimum = $round - Config::RoundsBetween(2);
        if($round_minimum < 0)
        {
            $round_minimum = 1;
        }
       $game_exist = Game::where([['white', '=', $player_one], ['black', '=', $player_two]])->whereBetween('round_id', [$round_minimum, $round])->get();
       $game_two_exist = Game::where([['white', '=', $player_two], ['black', '=', $player_one]])->whereBetween('round_id', [$round_minimum, $round])->get();
       if(($game_exist->isNotEmpty()) || ($game_two_exist->isNotEmpty()))
       {
           // Game exists, so return false.
           return false;
       } 
        // If valid return True;
        return true;
    }
    public function createGame($player_one, $player_two, $round){
        // Check color preference.
        // if Player_One has -2 he needs white
        // if Player_One has +2 he needs black
        // if equal, random
        // if Player_Two has -2 he needs white
        // if Player_Two has +2 he needs black
        // if -1 +1, opposite colors
        if($player_two == "Bye")
        {
            $game = new Game;
            $game->white = $player_one;
            $game->black = "Bye";
            $game->result = "1-0";
            $game->round_id = $round;
            $game->save();
            return true;
        }
        $color_value = Ranking::where('user_id', $player_one)->first();
        $color = $color_value->color;

     
            
        $color_value_black = Ranking::where('user_id', $player_two)->first();
        $color_black = $color_value_black->color;
        if($color == "-2")
        {
            $white = $player_one;
            $black = $player_two;
        }
        elseif($color_black == "-2")
        {
            $white = $player_two;
            $black = $player_one;
        }
        elseif($color == "2")
        {
            $white = $player_two;
            $black = $player_one;
        }
        elseif($color_black == "2"){
            $white = $player_one;
            $black = $player_two;
        }
        elseif($color == "-1" && $color_black == "1")
        {
            $white = $player_one;
            $black = $player_two;
        }
        elseif($color == "1" && $color_black == "-1")
        {
            $white = $player_two;
            $black = $player_one;
        }
        else
        {
            $color_random = rand(0,1);
            if($color_random = 0)
            {
                $white = $player_one;
                $black = $player_two;
            }
            else
            {
                $white = $player_two;
                $black = $player_one;
            }
        }
        
       
        $game = new Game;
        $game->white = $white;
        $game->black = $black;
        $game->result = "0-0";
        $game->round_id = $round;
        $game->save();

        // Update ranking of player
        $white_ranking = Ranking::where('user_id', $white)->first();
        $white_ranking->color = $white_ranking->color + 1;
        $white_ranking->save();
        $black_ranking = Ranking::where('user_id', $black)->first();
        $black_ranking->color = $black_ranking->color - 1;
        $black_ranking->save();
        return true;
    }
}
