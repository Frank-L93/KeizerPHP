<?php

namespace App\Actions;

use App\Helpers\TPRHelper;
use App\Models\Config;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use App\Notifications\RankingNotification;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Inertia\Inertia;

/** @package App\Actions */
class Calculate
{
    /** @return mixed  */
    public function GetRound()
    {
        try {
            $round = Round::where('processed', NULL)->orderby('round')->firstorfail();
        } catch (ModelNotFoundException $e) {

            return "NoResult";
        }

        return $round;
    }

    /**
     * @param mixed $games 
     * @param mixed $round 
     * @return void 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function ProcessGames($games, $round)
    {
        $rankings = Ranking::all();

        foreach ($rankings as $ranking) {
            $ranking->score = 0;
            $ranking->amount = 0;
            $ranking->gamescore = 0;
            $ranking->ratop = 0;
            $ranking->color = 0;
            $ranking->save();
        }

        foreach ($games as $game) {
            // decide the result for white and for black
            if ($game['result'] == "Afwezigheid") {
                $white_ranking = Ranking::where('user_id', $game['white'])->first();

                // Check if player exist in Ranking, if not, add person to ranking.
                if ($white_ranking == NULL) {
                    $white_ranking = new Ranking;
                    $white_ranking->user_id = $game['white'];
                    $white_ranking->score = 0;
                    $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();
                    $white_ranking->value = $lowest_value->value - 1;
                    $white_ranking->save();

                    // Set the new created Ranking as white_ranking again.
                    $white_ranking = Ranking::where('user_id', $game['white'])->first();
                }
                if ($white_ranking->score == 0) {
                    $white_score = $white_ranking->value; // value 60
                } else {
                    $white_score = $white_ranking->score;
                }
                // We have multiple options for the Afwezigheid-results --> Black = Club, Black = Other or Black = Personal
                if ($game['black'] == "Club") {

                    if ($game['round_id'] < $round) {
                        $white_score += Config::Scoring("Club") * $white_ranking->LastValue; //53*2/3
                    } elseif ($game['round_id'] > $round) {
                        // Do not consider games that are in future rounds (i.e. games due to absence)
                    } else {
                        $white_score += Config::Scoring("Club") * $white_ranking->value;
                    }
                } elseif ($game['black'] == "Personal") {
                    if ($game['round_id'] < $round) {
                        $white_score += Config::Scoring("Personal") * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $white_score += Config::Scoring("Personal") * $white_ranking->value;
                    }
                } else {
                    // Check if Absence Max is hit, otherwise let the player score.
                    $absence_max = Config::AbsenceMax();

                    // Season parts
                    $season_part = Config::SeasonPart();
                    // filter this for the first X rounds.
                    if ($game['round_id'] <= $season_part) {
                        $amount_absence = Game::where([['white', '=', $game['white']], ['round_id', '<=', $season_part], ['result', '=', 'Afwezigheid'], ['black', '=', 'Other']])->count();
                    } else {
                        $amount_absence = Game::where([['white', '=', $game['white']], ['round_id', '>', $season_part], ['result', '=', 'Afwezigheid'], ['black', '=', 'Other']])->count();
                    }
                    if ($amount_absence > $absence_max) {
                    } else {
                        if ($game['round_id'] < $round) {
                            $white_score += Config::Scoring("Other") * $white_ranking->LastValue;
                        } elseif ($game['round_id'] > $round) {
                        } else {
                            $white_score += Config::Scoring("Other") * $white_ranking->value;
                        }
                    }
                }
                $white_ranking->score = $white_score;
                $white_ranking->save();
            } // Result is not Afwezigheid.
            else {
                $result = explode("-", $game['result']);
                $white_result = $result[0];
                $black_result = $result[1];

                // Find white and black in the ranking
                $white_ranking = Ranking::where('user_id', $game['white'])->first();


                // Check if player exist in Ranking, if not, add person to ranking.
                if ($white_ranking == NULL) {
                    $white_ranking = new Ranking;
                    $white_ranking->user_id = $game['white'];
                    $white_ranking->score = 0;
                    $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();
                    $white_ranking->value = $lowest_value->value - 1;
                    $white_ranking->save();

                    // Set the new created Ranking as white_ranking again.
                    $white_ranking = Ranking::where('user_id', $game['white'])->first();
                }
                $white_rating = User::where('id', $game['white'])->first();

                // Defaults; //69.05
                if ($white_ranking->score == 0) {
                    $white_score = $white_ranking->value; // 60
                } else {
                    $white_score = $white_ranking->score;
                }
                if ($game['black'] == "Bye") {
                } else {
                    $black_ranking = Ranking::where('user_id', $game['black'])->first();

                    // Check if player exist in Ranking, if not, add person to ranking.
                    if ($black_ranking == NULL) {
                        $black_ranking = new Ranking;
                        $black_ranking->user_id = $game['black'];
                        $black_ranking->score = 0;
                        $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();
                        $black_ranking->value = $lowest_value->value - 1;
                        $black_ranking->save();

                        // Set the new created Ranking as white_ranking again.
                        $black_ranking = Ranking::where('user_id', $game['black'])->first();
                    }
                    $black_rating = User::where('id', $game['black'])->first();
                    if ($black_ranking->score == 0) {
                        $black_score = $black_ranking->value;
                    } else {
                        $black_score = $black_ranking->score;
                    }
                }

                // Calculate the new score for white and black for this game or all games?
                if ($game['black'] == "Bye") {
                    if ($game['round_id'] < $round) {
                        $white_score += Config::Scoring("Bye") * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $white_score += Config::Scoring("Bye") * $white_ranking->value;
                    }
                    $white_score += Config::Scoring("Presence");
                } elseif ($white_result == "1") {
                    if ($game['round_id'] < $round) {
                        $white_score += 1 * $black_ranking->LastValue;  //
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $white_score += 1 * $black_ranking->value; //58+60 = 118.05 + 59 = 178.1 + 28.5 = 205.65 
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $white_ranking->gamescore = $white_ranking->gamescore + 1;
                    if (Config::UsagePresenceScore() == true) {
                        $white_score += Config::Scoring("Presence");
                    }
                    $black_score += Config::Scoring("Presence");
                } elseif ($white_result == "1R") {
                    if ($game['round_id'] < $round) {
                        $white_score += 1 * $black_ranking->LastValue;  //
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $white_score += 1 * $black_ranking->value; //58+60 = 118.05 + 59 = 178.1 + 28.5 = 205.65 
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $white_ranking->gamescore = $white_ranking->gamescore + 1;
                    if (Config::UsagePresenceScore() == true) {
                        $white_score += Config::Scoring("Presence");
                    }
                } elseif ($white_result == 0.5) {   //69.05 += 0.5 * 69 = 69.05 + 34.5 = 103.60
                    if ($game['round_id'] < $round) {
                        $white_score += $white_result * $black_ranking->LastValue;
                        $black_score += $black_result * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $white_score += $white_result * $black_ranking->value;
                        $black_score += $black_result * $white_ranking->value;
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $white_ranking->gamescore = $white_ranking->gamescore + 0.5;
                    $black_ranking->gamescore = $black_ranking->gamescore + 0.5;
                    if (Config::UsagePresenceScore() == true) {
                        $white_score += Config::Scoring("Presence");
                        $black_score += Config::Scoring("Presence");
                    }
                } elseif ($black_result == "1") {
                    if ($game['round_id'] < $round) {
                        $black_score += 1 * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $black_score += 1 * $white_ranking->value;
                    }
                    $white_ranking->amount = $white_ranking->amount + 1;
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $black_ranking->gamescore = $black_ranking->gamescore + 1;
                    if (Config::UsagePresenceScore() == true) {
                        $black_score += Config::Scoring("Presence");
                    }
                    $white_score += Config::Scoring("Presence");
                } elseif ($black_result == "1R") {
                    if (
                        $game['round_id'] < $round
                    ) {
                        $black_score += 1 * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $black_score += 1 * $white_ranking->value;
                    }
                    $black_ranking->amount = $black_ranking->amount + 1;
                    $black_ranking->gamescore = $black_ranking->gamescore + 1;
                    if (Config::UsagePresenceScore() == true) {
                        $black_score += Config::Scoring("Presence");
                    }
                } else // No result yet?
                {
                    continue;
                }

                $white_ranking->score = $white_score;
                $white_ranking->color = $white_ranking->color + 1;
                $white_ranking->save();
                if ($game['black'] == "Bye" || $game['result'] == "Afwezigheid") {
                    $white_ranking->color = $white_ranking->color - 1;
                    $white_ranking->save();
                } else {
                    if ($black_result == "1R") { // White didn't play
                    } else {
                        if ($black_rating->rating == 0) {
                            $white_ranking->ratop = $white_ranking->ratop + 1000;
                        } else {
                            $white_ranking->ratop = $white_ranking->ratop + $black_rating->rating;
                        }

                        $white_ranking->save();
                    }
                    $white_ranking->TPR = $this->calculateTPR($game['white']);
                    $white_ranking->save();

                    $black_ranking->score = $black_score;
                    if ($white_result == "1R") {
                    } else {
                        if ($white_rating->rating  == 0) {
                            $black_ranking->ratop = $black_ranking->ratop + 1000;
                        } else {
                            $black_ranking->ratop = $black_ranking->ratop + $white_rating->rating;
                        }
                        $black_ranking->save();
                    }
                    $black_ranking->TPR = $this->calculateTPR($game['black']);
                    $black_ranking->save();


                    $black_ranking->score = $black_score;
                    $black_ranking->color = $black_ranking->color - 1;
                    $black_ranking->save();
                }
            }
        }
    }

    /**
     * @param mixed $ClosingRound 
     * @return void 
     */
    public function CloseRound($ClosingRound)
    {
        $round = Round::where('id', $ClosingRound['id'])->first();

        $round->processed = 1;
        $round->save();
    }

    /**
     * @param mixed $player 
     * @return mixed 
     */
    public function calculateTPR($player)
    {
        $user = Ranking::where('user_id', $player)->first();
        if ($user->amount == 0) {
            $tpr = 0;
            return $tpr;
        }

        $divide = $user->gamescore / $user->amount;
        $average_rating = $user->ratop / $user->amount;
        $based_on_divide = $this->GetValueForTPR($divide);
        $tpr = $average_rating + $based_on_divide;
        return $tpr;
    }

    /**
     * @param mixed $amount 
     * @return mixed 
     */
    public function GetValueForTPR($amount)
    {
        $amount = round($amount, 2);
        $value = TPRHelper::where('p', $amount)->first();
        if ($value == null) {
            return 0;
        }
        return $value->dp;
    }

    // Update the ranking as now the scores are processed.
    /** @return void  */
    public function UpdateRanking()
    {
        $Ranking = Ranking::orderBy('score', 'desc')->get();
        $i = Config::InitRanking("start");
        foreach ($Ranking as $rank) {
            $rank->LastValue2 = $rank->LastValue;
            $rank->LastValue = $rank->value;
            $rank->value = $i;
            $rank->save();
            $i = $i - Config::InitRanking("step");
        }
    }

    // The ranking should be saved if the season part is over.
    /** @return void */
    public function EndSeasonPart($round)
    {
        // 4, 8, 12, 16, 20
        // 1, 2, 3, 4,...
        // 13, 26, 39,

        $division = $round['round'] / Config::SeasonPart();
        if (fmod($division, 1) !== 0.0) {
            // Do nothing
        } else {
            // This is a season part.
            // Save the ranking to a EndSeasonPart or add a column to the rankings-table?
            // i.e. a JSON-column: [SeasonPart => 1, Score 1], [SeasonPart 2 => Score 2]
            $Ranking = Ranking::orderBy('score', 'desc')->get();
            foreach ($Ranking as $rank) {
                $newSeasonParts = [];
                $oldSeasonParts = $rank->SeasonParts;
                $newSeasonParts = array_push($oldSeasonParts, [$division => ['part_score' => $rank->score, 'part_value' => $rank->value]]);
                $rank->SeasonParts = $newSeasonParts;
                $rank->save();
            }
        }
    }

    /**
     * @param mixed $round 
     * @return true 
     */
    public function NotifyNewRanking($round)
    {
        $Ranking = Ranking::orderBy('score', 'desc')->limit('3')->get();
        $ranking_notify = [];
        $i = 1;
        foreach ($Ranking as $rank) {
            array_push($ranking_notify, [$i => [$rank, $rank->user]]);
            $i++;
        }
        $users = User::all();
        foreach ($users as $user) {
            if ($user->hasSettings->notifications == true) {
                if ($user->hasSettings->NotifyByMail == true) {
                    $user->notify(new RankingNotification($ranking_notify, "mail"));
                }
                if ($user->hasSettings->NotifyByDB == true) {
                    $user->notify(new RankingNotification($ranking_notify, "database"));
                }
                if ($user->hasSettings->NotifyByRSS == true) {
                    //$user->notify(new RankingNotification($Ranking, "RSS")); wip
                }
            }
        }
        return true;
    }
}
