<?php

namespace App\Http\Controllers;

use App\Actions\Calculate;
use App\Helpers\TPRHelper;
use App\Models\Config;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Inertia\Inertia;

class RankingsController extends Controller
{
    //

    public function admin()
    {
        $rankings = Ranking::with('user')->orderBy('score')->get();
        return Inertia::render('Admin/Rankings/Index')->with('Rankings', $rankings);
    }


    private function sort_rating($a, $b)
    {
        return strnatcmp($b['rating'], $a['rating']);
    }

    public function create()
    {
        $round_id = Round::all()->sortBy('round', SORT_REGULAR, false)->first();
        $presences = Presence::where('round', $round_id->id)->get();
        $users_present = array();
        foreach ($presences as $presence) {
            $user_that_is_present = User::where('id', $presence->user_id)->first();

            $user_array = ["id" => $user_that_is_present->id, "rating" => $user_that_is_present->rating];

            array_push($users_present, $user_array);
        }

        usort($users_present, array($this, 'sort_rating'));

        $i = Config::InitRanking("start");
        foreach ($users_present as $user) {

            $ranking_exist = Ranking::where('user_id', $user["id"])->get();
            if ($ranking_exist->isEmpty()) {
                $ranking = new Ranking;
                $ranking->user_id = $user["id"];
                $ranking->score = 0;
                $ranking->value = $i;
                $ranking->save();
                $i = $i - Config::InitRanking("step");
            }
        }
        return redirect('/admin/rankings')->with('success', 'Ranglijst aangemaakt');
    }

    public function process()
    {

        // Process games of the last round.
        $calculation = new Calculate;

        $round = $calculation->GetRound();


        if ($round == "NoResult") {
            return redirect('/admin/games')->with('error', "Geen rondes meer om te verwerken!");
        }
        $games = Game::where('round_id', '<=', $round->id)->with('whitePlayer', 'blackPlayer')->get();

        return Inertia::render('Admin/Rankings/Update')->with('round', $round)->with('games', $games);
    }

    public function processGames(Request $request)
    {
        // Process the games.

        $calculation = new Calculate;
        $processingGames = $calculation->ProcessGames($request->games, $request->round['id']);
        $updatedRanking = $calculation->UpdateRanking();
        $closingRound = $calculation->CloseRound($request->round);
        $notifyPlayers = $calculation->NotifyNewRanking($request->round);

        return redirect('/admin/rankings')->with('success', 'Ranglijst is geupdatet');
    }

    public function patch(Request $request)
    {
        $ranking = Ranking::find($request->id);
        foreach ($request->query as $key => $item) {
            if ($key == "user") {
            } else {
                $ranking->$key = $item;
            }
        }
        $ranking->save();
        return redirect('/admin/rankings')->with('success', 'Ranglijst aangepast');
    }
}
