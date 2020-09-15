<?php
namespace App;

Use App\Ranking;
Use App\Game;
Use App\Config;
Use App\User;
Use App\Round;
use App\Http\Controllers\iOSNotificationsController;
use App\Http\Controllers\PushController;

class Calculation
{
    /* The Calculcation Class has a couple of functions:
    ** Calculate, to initiate the calculation of new scores
    ** $rankings, $round, $games, $configs
    ** TPR Calculation (which will be helped by the TPR-Helper)
    ** Updating, which updates the RankingList after the scores have been calculated.
    */

    // We will give the function Calculate an inputvalue of a round, so we know which round is the latest round to be calculated.

    public function Calculate($round) // 1
    {
        // Make round an int (just in case it is passed on as a string)
        $round = $round * 1;
        
        // Get all rankings, as we need to work with these.
        $rankings = Ranking::all();

        // Reset score as we do recalculating the score of previous rounds based on value in this round
        // Also reset amount, gamescore & ratop as we loop through all games again. So if we keep it the value it already has, it will duplicate itself!
        
        foreach($rankings as $ranking)
        {
            $ranking->amount = 0;
            $ranking->gamescore = 0;
            $ranking->ratop = 0;
            $ranking->save();
        }

        // Get all games.
        $games = Game::where('round_id', '<=', $round)->get();
        foreach($games as $game)
        {
            // decide the result for white and for black
            if($game->result == "Afwezigheid")
            {
                $white_ranking = Ranking::where('user_id', $game->white)->first();
                
                // Check if player exist in Ranking, if not, add person to ranking.
                if($white_ranking == NULL)
                {
                    $white_ranking = new Ranking;
                    $white_ranking->user_id = $game->white;
                    $white_ranking->score = 0;
                    $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();
                    $white_ranking->value = $lowest_value->value - 1;  
                    $white_ranking->save();

                    // Set the new created Ranking as white_ranking again.
                    $white_ranking = Ranking::where('user_id', $game->white)->first();
                }
                if($white_ranking->score == 0)
                {
                    $white_score = $white_ranking->value + $white_ranking->score;
                }
                else
                {
                    $white_score = $white_ranking->score;
                }
                // We have multiple options for the Afwezigheid-results --> Black = Club, Black = Other or Black = Personal
                if($game->black == "Club"){
                    
                    if($game->round_id < $round)
                    {
                        $white_score += Config::Scoring("Club") * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        // Do not consider games that are in future rounds (i.e. games due to absence)
                    }
                    else
                    {
                        $white_score += Config::Scoring("Club") * $white_ranking->value;
                    }
                }
                elseif($game->black == "Personal"){
                    if($game->round_id < $round)
                    {
                        $white_score += Config::Scoring("Personal") * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $white_score += Config::Scoring("Personal") * $white_ranking->value;
                    }
                }
                else{
                    // Check if Absence Max is hit, otherwise let the player score.
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
                        $white_score += Config::Scoring("Other") * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $white_score += Config::Scoring("Other") * $white_ranking->value;
                    }
                    }
                }
                $white_ranking->score = $white_score;
                $white_ranking->save();
                
            } // Result is not Afwezigheid.
            else
            {
                $result = explode("-", $game->result);
                $white_result = $result[0];
                $black_result = $result[1];
                
                // Find white and black in the ranking
                $white_ranking = Ranking::where('user_id', $game->white)->first();
                $white_rating = User::where('id', $game->white)->first();
            
                // Defaults; //69.05
                if($white_ranking->score == 0)
                {
                    $white_score = $white_ranking->value + $white_ranking->score;
                }
                else
                {
                    $white_score = $white_ranking->score;
                }
                if($game->black == "Bye")
                {
                
                }
                else
                {
                    $black_ranking = Ranking::where('user_id', $game->black)->first();
                    $black_rating = User::where('id', $game->black)->first();
                    if($black_ranking->score == 0)
                    {
                        $black_score = $black_ranking->value + $black_ranking->score;
                    }
                    else
                    {
                        $black_score = $black_ranking->score;
                    }
                }
              
                // Calculate the new score for white and black for this game or all games?
                if($game->black == "Bye")
                {   
                    if($game->round_id < $round)
                    { 
                        $white_score += Config::Scoring("Bye") * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $white_score += Config::Scoring("Bye") * $white_ranking->value; 
                    }
                    $white_score += Config::Scoring("Presence");
                }
                elseif($white_result == 1)
                {
                    if($game->round_id < $round)
                    {
                        $white_score += $white_result * $black_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $white_score += $white_result * $black_ranking->value;
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $white_ranking->gamescore = $white_ranking->gamescore + 1;
                    $white_score += Config::Scoring("Presence");
                    $black_score += Config::Scoring("Presence");
                }
                elseif($white_result == 0.5)
                {   //69.05 += 0.5 * 69 = 69.05 + 34.5 = 103.60
                    if($game->round_id < $round)
                    {
                        $white_score += $white_result * $black_ranking->LastValue;
                        $black_score += $black_result * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $white_score += $white_result * $black_ranking->value;
                        $black_score += $black_result * $white_ranking->value;
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $white_ranking->gamescore = $white_ranking->gamescore + 0.5;
                    $black_ranking->gamescore = $black_ranking->gamescore + 0.5;
                    $white_score += Config::Scoring("Presence");
                    $black_score += Config::Scoring("Presence");
                }
                elseif($black_result == 1)
                {
                    if($game->round_id < $round)
                    {
                        $black_score += $black_result * $white_ranking->LastValue;
                    }
                    elseif($game->round_id > $round)
                    {
                        
                    }
                    else
                    {
                        $black_score += $black_result * $white_ranking->value;
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $black_ranking->gamescore = $black_ranking->gamescore + 1;
                    $black_score += Config::Scoring("Presence");
                    $white_score += Config::Scoring("Presence");
                }
                else // No result yet?
                {
                    continue;
                }
                
                $white_ranking->score = $white_score;
                $white_ranking->save();
                if($game->black == 0)
                {
                }
                else
                {
                    $white_ranking->ratop = $white_ranking->ratop + $black_rating->rating;
                    $white_ranking->save();
                    $white_ranking->TPR = $this->calculateTPR($game->white);
                    $white_ranking->save();
                    $black_ranking->score = $black_score;
                    $black_ranking->ratop = $black_ranking->ratop + $white_rating->rating;
                    $black_ranking->save();
                    $black_ranking->TPR = $this->calculateTPR($game->black);
                    $black_ranking->save();
                }
            }
        }
        $round_processed = Round::find($round);
        $round_processed->processed = 1;
        $round_processed->save();
        return $this->UpdateRanking();
    }

    // TPR
    public function calculateTPR($player)
    {
        $user = Ranking::where('user_id', $player)->first();
        if($user->amount == 0)
        {
            $tpr = 0;
            return $tpr;
        }
        
        $divide = $user->gamescore / $user->amount;
        $average_rating = $user->ratop / $user->amount;
        $based_on_divide = $this->GetValueForTPR($divide);
        $tpr = $average_rating + $based_on_divide;
        return $tpr; 
    }

    public function GetValueForTPR($amount)
    {
        $amount = round($amount, 2);
        $value = TPRHelper::where('p', $amount)->first();
        if($value == null)
        {
            return 0;
        }
        return $value->dp;
    }
   
     // Update the ranking as now the scores are processed.
     public function UpdateRanking()
     {
         $Ranking = Ranking::orderBy('score', 'desc')->get();
         $i = Config::InitRanking("start");
         foreach($Ranking as $rank)
         {
            
             $rank->LastValue = $rank->value;
             $rank->value = $i;
             $rank->save();
             $i = $i - Config::InitRanking("step");
         }
        $b = new iOSNotificationsController();
        $b->newFeedItem('Stand', 'De stand is bijgewerkt, bekijk hem nu!', 'https://interndepion.nl/rankings', '1');
        $a = new PushController();
        $a->push('Admin', 'De stand is bijgewerkt, bekijk hem nu!', 'Stand', '1'); // Get results of round
        return redirect('/Admin')->with('success', 'Stand is bijgewerkt en notificaties verzonden');
     }
}