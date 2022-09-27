<?php

namespace App\Helpers;

use App\Models\Config;
use App\Models\Game;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

// Not really a Helper
/** @package App\Helpers */
class CurrentScores
{

    /**
     * @param User $user 
     * @return array 
     */
    public function getCurrentScore(User $user, Round $round): array
    {
        $round = $round->id;
        $scores = [];

        // We have a lot in common with the Calculate-action, however we do not need to update the Ranking; so exclude that part.

        $games = Game::where('white', $user->id)->orWhere('black', $user->id)->get();

        // win of 34; win of 36; lose of 42;
        foreach ($games as $game) {
            $white_score = 0;
            $black_score = 0;
            // decide the result for white and for black
            if ($game['result'] == "Afwezigheid") {
                $white_ranking = Ranking::where('user_id', $game['white'])->first();

                // Check if player exist in Ranking, if not, add person to ranking.
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
            } // Result is not Afwezigheid.
            else {
                $result = explode("-", $game['result']);
                $white_result = $result[0];
                $black_result = $result[1];

                // Find white and black in the ranking
                $white_ranking = Ranking::where('user_id', $game['white'])->first();

                // Defaults; //69.05

                if ($game['black'] == "Bye") {
                } else {
                    $black_ranking = Ranking::where('user_id', $game['black'])->first();
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
                    if (Config::UsagePresenceScore() == true) {
                        $black_score += Config::Scoring("Presence");
                    }
                    $white_score += Config::Scoring("Presence");
                } elseif ($black_result == "1R") {
                    if ($game['round_id'] < $round) {
                        $black_score += 1 * $white_ranking->LastValue;
                    } elseif ($game['round_id'] > $round) {
                    } else {
                        $black_score += 1 * $white_ranking->value;
                    }
                    if (Config::UsagePresenceScore() == true) {
                        $black_score += Config::Scoring("Presence");
                    }
                    $white_score += Config::Scoring("Presence");
                } else // No result yet?
                {
                    continue;
                }
                if (intval($game['black'])) {
                    $own_score = match ($user->id) {
                        $game['white'] => $white_score,
                        intval($game['black']) => $black_score,
                    };
                } else {
                    $own_score = $white_score;
                }
            }
            array_push($scores, ['id' => $game->id, 'score' => $own_score]);
        }

        return $scores;
    }
}
