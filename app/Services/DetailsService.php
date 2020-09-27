<?php

namespace App\Services;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Game;
use App\Ranking;
use App\Round;
use App\Config;

class DetailsService
{
    public function Games($player)
    {
        $currentRound = Round::where('processed', '=', NULL)->first();
        $Games = Game::where([['white','=', $player],['round_id', '<=', $currentRound->round]])->orWhere([['black', '=', $player], ['round_id', '<=', $currentRound->round]])->get();
        return $Games;
    }

    public function PlayerName($player)
    {
        if($player == "Bye")
        {
            return "Bye";
        }
        elseif($player == "Other" || $player == "Club" || $player == "Personal")
        {
            return "-";
        }
        else
        {
            $player = intval($player);
            $PlayerName = User::select('name')->where('id', '=', $player)->first();
            return $PlayerName->name;
        }
    }

    public function CurrentScore($player, $selectedRound)
    {
        // Get the Game;
        $game = Game::where([['white','=', $player],['round_id', '=', $selectedRound]])->orWhere([['black', '=', $player], ['round_id', '=', $selectedRound]])->first();
        // Get the current Round to determine if round game round is earlier.
        $currentRound = Round::where('processed', '=', 1)->latest('updated_at')->first();
        $round = $currentRound->round + 1;
        
        // Set score to 0;
        $score = 0;
        
        // Check for Absence Game;
        if($game->white == $player && $game->result == "Afwezigheid")
        {
            // Set White Score to 0
            $white_score = 0;
            // Get the ranking for the values.
            $white_ranking = Ranking::where('user_id', $game->white)->first();
            
            // Club
            if($game->black == "Club")
            {
                if($game->round < $round)
                {
                    $white_score = Config::Scoring("Club") * $white_ranking->LastValue;
                }
                else
                {
                    $white_score = Config::Scoring("Club") * $white_ranking->value;
                }
            }
            elseif($game->black == "Personal"){
                if($game->round < $round)
                {
                   $white_score = Config::Scoring("Personal") * $white_ranking->LastValue;
                }
                else
                {
                    $white_score = Config::Scoring("Personal") * $white_ranking->value;
                }
            }
            else{
                $absence_max = Config::AbsenceMax();
                // Season parts
                $season_part = Config::SeasonPart();
                // filter this for the first X rounds.
                if($game->round_id <= $season_part)
                {
                    $amount_absence = Game::where([['white', '=', $game->white], ['round_id', '<=', $season_part], ['result', '=', 'Afwezigheid'], ['black', '=', 'Other']])->count();
                }
                else
                {
                    $amount_absence = Game::where([['white', '=', $game->white], ['round_id', '>', $season_part], ['result', '=', 'Afwezigheid'], ['black', '=', 'Other']])->count();
                }
                if($amount_absence > $absence_max)
                    {}
                else
                {
                    if($game->round_id < $round)
                    {
                        $white_score = Config::Scoring("Other") * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score = Config::Scoring("Other") * $white_ranking->value;
                    }
                }
            }
            $score = $white_score;
            return $score;    
        }
        else
        {
            if(($game->white == $player && $game->result != "Afwezigheid") || ($game->black == $player && $game->result != "Afwezigheid"))
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
                        $white_score = Config::Scoring("Bye") * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score = Config::Scoring("Other") * $white_ranking->value;
                    }
                    $white_score += 0.05;
                }
                elseif($white_result == 1)
                {
                    if($game->round < $round)
                    {
                        $white_score = $white_result * $black_ranking->LastValue;
                    }
                    else
                    {
                        $white_score = $white_result * $black_ranking->value;
                    }
                    $white_score += 0.05;
                    $black_score += 0.05;
                    
                }
                elseif($white_result == 0.5)
                {   //69.05 += 0.5 * 69 = 69.05 + 34.5 = 103.60
                    if($game->round < $round)
                    {
                        $white_score = $white_result * $black_ranking->LastValue;
                        $black_score = $black_result * $white_ranking->LastValue;
                    }
                    else
                    {
                        $white_score = $white_result * $black_ranking->value;
                        $black_score = $black_result * $white_ranking->value;
                    }
                    $white_score += 0.05;
                    $black_score += 0.05;
                }
                elseif($black_result == 1)
                {
                    if($game->round < $round)
                    {
                        $black_score = $black_result * $white_ranking->LastValue;
                    }
                    else
                    {
                        $black_score = $black_result * $white_ranking->value;
                    }
                    $black_score += 0.05;
                    $white_score += 0.05;
                }
                else // No result yet?
                {
                    return "Fout bij berekenen";
                }
                
                if($game->white == $player)
                {
                    $score = $white_score;
                    return $score;
                }
                elseif($game->black == $player)
                {
                    $score = $black_score;
                    return $score;   
                }
             }
        }
    }
}