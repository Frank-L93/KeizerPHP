<?php

namespace App\Actions;

use App\Models\Config;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class Pair
{
    // Keizer pairing
    public function keizer(Round $round, $presences)
    {
        // We assume that a Bye is necessary to pair, but if the amount of players to pair is even, we set this value to false.
        $bye_necessary = true;

        //We need to fill some player data
        $enriched_players = $this->players($presences);
        if (empty($enriched_players)) {
            return "Geen indeling mogelijk, er zijn geen spelers aanwezig!";
        }
        // Check if last player has an outlining rating
        if (count($enriched_players) > 2) {
            if ($this->CheckIfOkToPairThisWay(end($enriched_players)["rating"], $enriched_players[count($enriched_players) - 2]["rating"]) == false) {
                $enriched_players = $this->moveElement($enriched_players, count($enriched_players) - 1, count($enriched_players) - rand(2, count($enriched_players) - 1));
            }
        }


        if (count($enriched_players) % 2 == 0) {
            $bye_necessary = false;
        }

        $text = $this->MatchGame($enriched_players, $round->id, $bye_necessary);
        // should return a collection of games.
        $round->paired = 1;
        $round->save();
        if ($text != "Succes") {

            return $text;
        }
        $paired_games = Game::where('round_id', $round->id)->get();

        return $paired_games;
    }

    private function players($presences)
    {
        $sorted_players = [];


        foreach ($presences as $player) {
            // The player that is being matched is not yet in the rankings
            if ($player->user->ranking == NULL) {
                // Trigger the addition of a new player to the rankings.
                $this->addPlayerToRanking($player);
            }
            array_push($sorted_players, ["user" => $player->user_id, "value" => $player->user->ranking->value, "rating" => $player->user->rating, "color" => $player->user->ranking->color]);
        }

        usort($sorted_players, array($this, 'sort_value'));
        return $sorted_players;
    }


    /**
     * 
     * @param mixed $a 
     * @param mixed $b 
     * @return int 
     */
    private function sort_value($a, $b)
    {
        return strnatcmp($b['value'], $a['value']);
    }

    /**
     * 
     * @param mixed $a 
     * @param mixed $b 
     * @return bool 
     */
    private function CheckIfOkToPairThisWay($a, $b)
    {

        // if a too big difference, 
        $c = 0;
        $math = rand(0, 6);
        if ($a - $b > 500) {
            $c = ($a / 100 - $b / 100);
        }
        if (
            $math + $c > 10
        ) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * 
     * @param mixed $array 
     * @param mixed $a 
     * @param mixed $b 
     * @return array 
     */
    private function moveElement(&$array, $a, $b)
    {
        $out = array_splice($array, $a, 1);
        array_splice($array, $b, 0, $out);

        return $array;
    }




    public function MatchGame($playerstopair, $round, $bye_necessary) // matches players
    {
        $matches = array();
        $matched = array();

        if (
            $bye_necessary == true
        ) {
            $k = 0;

            Bye:
            if ($k == count($playerstopair)) {
                return "Na " . $k . " pogingen, gestopt vanwege: Invalid Bye, can not Match. Create games manually.";
            }

            $bye = 0;
            if (count($playerstopair) !== 1) {

                $luckFactor = rand(0, 100);

                // Give bye to last player with an earlier played game or, if luck factor is high enough, make it random.
                if ($luckFactor > 50) {
                    $bye = rand(0, count($playerstopair)); // Random Bye
                } else {
                    $bye = count($playerstopair) - $k;
                }
            }

            if ($this->validBye($playerstopair[$bye - 1], $round) == true) {
                $this->createGame($playerstopair[$bye]["user"], "Bye", $round);
                array_push($matched, $playerstopair[$bye]["user"]);
            } else {
                $k++;
                goto Bye;
            }
        }

        foreach ($playerstopair as $playertopair) {

            if (in_array($playertopair["user"], $matched) == false) {
                // Player is not yet paired, so find an available opponent:
                // Preferred opponent is next in $playerstopair, or the most closest one that is a valid opponent.
                // Valid opponent is a player that is not yet paired and a player who has not played against our player being paired in the last X rounds.
                // Also the color should be checked (if both are on -2 or +2 they can't play against eachother, if one is on -2 or + 2, and the other is on -1 or +1, it is possible, giving the player with the -2 / +2 the correct color)
                foreach ($playerstopair as $opponent) {

                    if ($opponent == $playertopair || (in_array($opponent["user"], $matched) == true)) {
                        // Just skip this one as the opponent is the player being paired or the opponent being paired is already paired.
                    } else {
                        // Opponent is not paired yet, and opponent is not or player being paired
                        // Check if Opponent is valid for this Player.
                        if ($this->validOpponent($playertopair["user"], $opponent["user"], $round, count($matched), count($playerstopair), $playertopair["color"], $opponent["color"]) == true) {
                            // if Valid, deterime the colors.
                            $colorized = $this->Color($playertopair["user"], $opponent["user"], $playertopair["color"], $opponent["color"]);


                            if ($this->createGame($colorized[0], $colorized[1], $round) == true) {
                                array_push($matched, $opponent["user"]); // Add opponent to Matched Players
                                array_push($matched, $playertopair["user"]); // Add Player to Matched Players
                                // Now break this foreach loop and continue with the foreach loop of pairing players.
                                break;
                            } else {
                                return "Error with creating a game.";
                            }
                        }
                    }
                }
            } else {
                // Not necessary to pair
            }
        }
        if (count($matched) == count($playerstopair)) {
            // Notify Succesfull Pairing
            return "Succes";
        } else {
            // Notify Unsuccesfull Pairing
            return "Unsuccesfull Pairing, check pairings made manually.";
        }
    }

    /**
     * @param mixed $white 
     * @param mixed $black 
     * @param mixed $round_id 
     * @return bool 
     */
    private function createGame($white, $black, $round_id): Bool
    {
        if ($black == "Bye") {
            $game = new Game;
            $game->white = $white;
            $game->black = "Bye";
            $game->result = "1-0";
            $game->round_id = $round_id;
            if ($game->save()) {
                return true;
            }
        }

        $game = new Game;
        $game->white = $white;
        $game->black = $black;
        $game->result = "0-0";
        $game->round_id = $round_id;
        if ($game->save()) {
            return true;
        }
        return false;
    }

    /**
     * @param mixed $player_one 
     * @param mixed $round 
     * @return bool 
     */
    private function validBye($player_one, $round)
    {
        $round_minimum = $round - Config::RoundsBetween(1);
        if (
            $round_minimum < 0
        ) {
            $round_minimum = 1;
        }
        $bye_game_exist = Game::where([['white', '=', $player_one], ['black', '=', 'Bye']])->whereBetween('round_id', [$round_minimum, $round])->get();
        if (($bye_game_exist->isNotEmpty())) {
            return false;
        }
        // Check if the current player even had a game earlier, otherwise, the player will be here for the first time, then it is no valid bye.
        $game_exist = Game::where('white', $player_one)->orWhere('black', $player_one)->get();
        if ($game_exist->isEmpty()) {
            return false;
        }

        // If valid return True;
        return true;
    }

    /**
     * @param mixed $player_one 
     * @param mixed $player_two 
     * @param mixed $round 
     * @param mixed $amount_matched 
     * @param mixed $amount_to_match 
     * @param mixed $color_one 
     * @param mixed $color_two 
     * @return bool 
     */
    private function validOpponent($player_one, $player_two, $round, $amount_matched, $amount_to_match, $color_one, $color_two)
    {
        if ($amount_to_match - $amount_matched < 3) {
            return true;
        }

        if (($color_one == "-2" && $color_two == "-2") || ($color_one == "2" && $color_two == "2")) {
            return false;
        }
        // Not valid when:
        // Players have played against eachother in last X rounds.
        $round_minimum = $round - Config::RoundsBetween(2);
        if (
            $round_minimum < 0
        ) {
            $round_minimum = 1;
        }
        $game_exist = Game::where([['white', '=', $player_one], ['black', '=', $player_two]])->whereBetween('round_id', [$round_minimum, $round])->get();
        $game_two_exist = Game::where([['white', '=', $player_two], ['black', '=', $player_one]])->whereBetween('round_id', [$round_minimum, $round])->get();
        if (($game_exist->isNotEmpty()) || ($game_two_exist->isNotEmpty())) {
            // Game exists, so return false.
            return false;
        }
        $season_part = Config::SeasonPart();

        // returns 10
        // The current paired round is our round variable
        // If the round variable <= 10 we are in the first part of the season
        // Else we are in the second part of the season
        if ($round <= $season_part) {
            // Check for games in the first part of the season
            $game_exist = Game::where([['white', '=', $player_one], ['black', '=', $player_two]])->where('round_id', '<=', $season_part)->get();

            $game_two_exist = Game::where([['white', '=', $player_two], ['black', '=', $player_one]])->where('round_id', '<=', $season_part)->get();

            if (($game_exist->isNotEmpty()) || ($game_two_exist->isNotEmpty())) {
                // Game exists, so return false.
                return false;
            }
        } else {
            // Check for games in the second part of the season
            $game_exist = Game::where([['white', '=', $player_one], ['black', '=', $player_two]])->where('round_id', '>', $season_part)->get();
            $game_two_exist = Game::where([['white', '=', $player_two], ['black', '=', $player_one]])->where('round_id', '>', $season_part)->get();

            if (($game_exist->isNotEmpty()) || ($game_two_exist->isNotEmpty())) {
                // Game exists, so return false.
                return false;
            }
        }
        // If valid return True;
        return true;
    }

    /**
     * @param mixed $player_one 
     * @param mixed $player_two 
     * @param mixed $color_one 
     * @param mixed $color_two 
     * @return int[] 
     */
    private function Color($player_one, $player_two, $color_one, $color_two)
    {

        // 2 & 2  / -2 & -2 is not possible, if 0 & -1/1 or -1/1 & 0 or -1 & -1 or 1 & 1 random.
        if ($color_one == "-2") {
            $white = $player_one;
            $black = $player_two;
        } elseif ($color_two == "-2") {
            $white = $player_two;
            $black = $player_one;
        } elseif ($color_one == "2") {
            $white = $player_two;
            $black = $player_one;
        } elseif ($color_two == "2") {
            $white = $player_one;
            $black = $player_two;
        } elseif ($color_one == "-1" && $color_two == "1") {
            $white = $player_one;
            $black = $player_two;
        } elseif ($color_one == "1" && $color_two == "-1") {
            $white = $player_two;
            $black = $player_one;
        } else {
            $color_random = rand(0, 1);
            if ($color_random == 0) {
                $white = $player_one;
                $black = $player_two;
            } else {
                $white = $player_two;
                $black = $player_one;
            }
        }


        return [$white, $black];
    }

    /**
     * @param mixed $player 
     * @return never 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function addPlayerToRanking($player)
    {

        $newRanking = new Ranking;
        $newRanking->user_id = $player->user_id;
        $newRanking->score = 0;

        $player_unranked = User::find($player->user_id);


        $player_closest_by = DB::table('users')->join('rankings', 'users.id', '=', 'rankings.user_id')->select('users.id', 'users.rating', 'rankings.value', DB::raw('ABS(' . $player_unranked->rating . ' - users.rating) as difference'))->orderby('difference')->limit(1)->first();


        if ($player_closest_by == null) {
            //doe iets anders
            $lowest_value = Ranking::select('value')->orderBy('value', 'asc')->limit(1)->first();

            if ($lowest_value ==  Config::InitRanking('start')) {
                $newRanking->value = $lowest_value;
            } else {
                $newRanking->value = $lowest_value->value - 1;
            }
        } else {
            $newRanking->value = $player_closest_by->value;
        }
        if ($newRanking->save()) {
            return true;
        } else {
            return false;
        }
    }
    // Swiss pairing maybe ever
}
