<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Club;
use App\Models\Game;
use App\Models\Ranking;
use App\Models\Round;
use Illuminate\Http\Request;

class ClubsApiController extends Controller
{
    public function games($clubid): string
    {

        $firstRound = Round::withoutGlobalScopes()->where([['processed', '=', NULL], ['club_id', '=', $clubid]])->orderBy('date')->first();


        if ($firstRound == NULL) {
            $gamesInCurrentRound = "Er is geen komende ronde";
        } else {
            $gamesInCurrentRound =
                Game::query()->withoutGlobalScopes()->with(array('whitePlayer' => function ($query) {
                    $query->select('id', 'name');
                }, 'blackPlayer' => function ($query) {
                    $query->select('id', 'name');
                }))->orderBy('round_id')->where([['round_id', '=', $firstRound->id], ['club_id', '=', $clubid]])->select('id', 'white', 'black', 'result')->get();
        }
        return json_encode($gamesInCurrentRound);
    }

    public function getRanking($clubid): string
    {
        $top = Ranking::withoutGlobalScopes()->select('user_id', 'score')->where('club_id', $clubid)->orderBy('score', 'desc')->take(5)->with('user:id,name')->get();
        return json_encode($top);
    }

    public function detail($clubid): string
    {
        $club = Club::withoutGlobalScopes()->where('id', $clubid)->select('name')->get();
        return json_encode($club);
    }
}
