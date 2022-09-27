<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getCurrentPlayers(): string
    {
        $amount = User::count();
        $amountStandaardbeschikbaar = User::where('beschikbaar', 1)->count();
        return json_encode([$amount, $amountStandaardbeschikbaar]);
    }

    public function top(): string
    {
        $top = Ranking::select('user_id', 'score')->orderBy('score', 'desc')->take(3)->with('user:id,name')->get();
        return json_encode($top);
    }

    public function games(): string
    {
        $currentRound = Round::firstRound();

        if ($currentRound == NULL) {
            $gamesInCurrentRound = "Er is geen komende ronde";
        } elseif ($currentRound->published == 0) {
            $gamesInCurrentRound = "De partijen voor deze ronde zijn nog niet gepubliceerd";
        } else {
            $gamesInCurrentRound =
                Game::query()->with(array('whitePlayer' => function ($query) {
                    $query->select('id', 'name');
                }, 'blackPlayer' => function ($query) {
                    $query->select('id', 'name');
                }))->orderBy('round_id')->where('round_id', $currentRound->id)->get();
        }
        return json_encode($gamesInCurrentRound);
    }

    public function tpr(): string
    {
        $tpr = Ranking::select('user_id', 'tpr')->orderBy('tpr', 'desc')->take(1)->with('user:id,name')->get();
        return json_encode($tpr);
    }

    public function bestWin(): array
    {
        $gamesOfCurrentPlayer =
            Game::query()->with(array('whitePlayer' => function ($query) {
                $query->select('id', 'name', 'rating');
            }, 'blackPlayer' => function ($query) {
                $query->select('id', 'name', 'rating');
            }))->orderBy('round_id')->where([['white', '=', auth()->user()->id], ['result', '=', '1-0']])->orWhere([['black', '=', auth()->user()->id], ['result', '=', '0-1']])->get();

        $array = $gamesOfCurrentPlayer->toArray();

        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i]['white_player']['id'] == auth()->user()->id) {
                unset($array[$i]['white_player']);
                $array[$i]['opponnent'] = $array[$i]['black_player'];
                unset($array[$i]['black_player']);
            } else {
                unset($array[$i]['black_player']);
                $array[$i]['opponnent'] = $array[$i]['white_player'];
                unset($array[$i]['white_player']);
            }
        }


        usort($array, function ($a, $b) {
            if ($a["opponnent"] == NULL) {
                return 0;
            }
            if ($b["opponnent"] == NULL) {
                return 0;
            }
            if ($a["opponnent"]["rating"] == $b["opponnent"]["rating"]) {
                return 0;
            }
            return ($a["opponnent"]["rating"] > $b["opponnent"]["rating"]) ? -1 : 1;
        });

        if (count($array) > 0) {

            return $array[0];
        } else {
            return ["0" => "Geen partij gespeeld"];
        }
    }
    public function leftRounds(): string
    {
        $lastRound = Round::lastRound();
        if ($lastRound == NULL) {
            return "Geen rondes resterend";
        }
        $leftRounds = Round::where('processed', NULL)->get();

        return count($leftRounds);
    }

    public function firsttime(): void
    {
        $User = User::find(auth()->user()->id);
        $User->firsttimelogin = false;
        $User->save();
    }
}
