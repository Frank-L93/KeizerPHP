<?php

namespace App\Http\Controllers;

use App\Actions\Pair;
use App\Http\Requests\StoreGameRequest;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Round;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class GamesController extends Controller
{
    public function index()
    {

        $games = Game::with('whitePlayer', 'blackPlayer', 'round')->orderBy('round_id')->get();
        $users = User::all();

        return Inertia::render('Admin/Games/Index')->with('Games', $games)->with('Users', $users);
    }

    public function view(Request $round)
    {

        $round_id = Round::where('uuid', $round->query('round'))->get()[0];
        $navigation = Round::where('round', $round_id->round - 1)->orWhere('round', $round_id->round + 1)->select('round', 'uuid')->get();
        $games = Game::query()->with(array('whitePlayer' => function ($query) {
            $query->select('id', 'name');
        }, 'blackPlayer' => function ($query) {
            $query->select('id', 'name');
        }, 'round'))->orderBy('round_id')->when($round_id ?? false, fn ($query, $round_id) => $query->where('round_id', $round_id->id))->get();

        $rounds = Round::select('round', 'uuid')->get();
        return Inertia::render('Games/Show')->with('Games', $games)->with('Rounds', $rounds)->with('Navigation', $navigation);
    }

    public function generate()
    {
        //Ronde 1 is ingedeeld, en je wilt nu ronde 2 maken, maar ronde 1 heeft nog een partij openstaan --> zou niet moeten kunnen

        // Get the round to be processed
        $old_round = 0;
        $round_to_process = Round::where('processed', NULL)->orWhere('processed', 0)->orderBy('round')->first(); // pakte de eerste niet processed op

        // is nu 1

        if ($round_to_process == NULL) {
            $round_to_process = new Round;
            $round_to_process->id = 0;
        } else {
            $old_round = Round::find($round_to_process->round - 1);
        }
        if ($old_round == NULL) {
            $checked = $this->checkProcessedRound($round_to_process);
        } else {
            $checked = $this->checkProcessedRound($old_round);
        }

        if ($checked == false) {
            // redirect with error message
            return redirect('admin/games')->with('error', 'Er zijn nog openstaande partijen in de vorige ronde.');
        }

        // Start generating games
        // What do we need to generate games?
        // Players that are present in the round to be processed

        $present_players = $this->getPlayers($round_to_process);

        // Now we can start the matching procedure
        $paired = new Pair();
        $matching = $paired->keizer($round_to_process, $present_players);

        if (is_a($matching, 'Illuminate\Database\Eloquent\Collection')) {
            return redirect('admin/games')->with('success', 'Partijen aangemaakt, wil je een notificatie versturen?');
        } else {
            return redirect('admin/games')->with('error', $matching);
        }
    }

    public function create()
    {
        $users = User::all();
        $rounds = Round::all();
        return Inertia::render('Admin/Games/Create')->with('users', $users)->with('rounds', $rounds);
    }

    public function store(StoreGameRequest $request)
    {
        $unvalidatedGameData = $request;
        $validatedGameData = $request->validated();

        $game = new Game;
        $game->white = $validatedGameData['white'];
        $game->black = $validatedGameData['black'];
        $game->result = $validatedGameData['result'];
        $game->round_id = $unvalidatedGameData['round_id'];
        $game->save();
        return Inertia::render('Admin/Games/Index')->with('success', 'Partij aangemaakt.');
    }
    private function checkProcessedRound($round): Bool
    {

        // Old round does exist
        $result = Game::where('round_id', $round->id)->where('result', '0-0')->get();

        // If not empty, there are games to be processed first
        if (!$result->isEmpty()) {
            return false;
        }
        return true;
    }

    private function getPlayers($round)
    {

        // For some stupid reason I named the field round_id round at presences, but it is filled with the round->id. 
        $presences = Presence::where('round', $round->id)->where('presence', 1)->with('user')->get();
        return $presences;
    }

    public function patch(StoreGameRequest $request)
    {
        $newGameData = $request->validated();
        $Game = Game::find($newGameData['id']);

        $Game->white = $newGameData['white'];
        $Game->black = $newGameData['black'];
        $Game->result = $newGameData['result'];
        $Game->save();
        return redirect::route('admin.games')->with('success', 'Partij opgeslagen');
    }

    public function delete(Game $game)
    {
        $game->delete();

        return redirect('admin/games')->with('success', 'Partij verwijderd.');
    }
}
