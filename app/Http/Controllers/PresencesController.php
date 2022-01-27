<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresenceRequest;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Round;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class PresencesController extends Controller
{
    public function index()
    {
        $Presences = Presence::where('user_id', auth()->id())->with(['user', 'date'])->orderBy('round')->get();

        return Inertia::render('Presences/Show')->with('Presences', $Presences);
    }

    public function AdminIndex()
    {


        $presences = Presence::with(['user', 'date'])->orderBy('round')->get();
        return Inertia::render('Admin/Presences/Index')->with('Presences', $presences);
    }

    public function create()
    {
        $users = User::where('beschikbaar', 1)->get();
        if ($users->isEmpty()) {
            return redirect('admin/presences')->with('error', 'Aanwezigheden niet aangemaakt. Er zijn geen spelers waarvoor aanwezigheden aangemaakt moeten worden');
        }

        $rounds = Round::all();
        if ($rounds->isEmpty()) {
            return redirect('admin/presences')->with('error', 'Aanwezigheden niet aangemaakt. Er zijn geen rondes waarvoor aanwezigheden aangemaakt moeten worden. Heb je al rondes aangemaakt?');
        }

        foreach ($users as $user) {
            foreach ($rounds as $round) {
                $presence_exist = Presence::where([['user_id', '=', $user->id], ['round', '=', $round->id]])->get();

                if ($presence_exist->isEmpty()) {
                    $presence = new Presence;
                    $presence->user_id = $user->id;
                    $presence->round = $round->id;
                    $presence->club_id = $user->club_id;
                    $presence->presence = 1;
                    $presence->save();
                }
            }
        }
        return redirect('admin/presences')->with('success', 'Aanwezigheden gegenereerd');
    }

    public function singleCreate()
    {
        $rounds = Round::select('date')->orderBy('date')->get();
        if ($rounds->isEmpty()) {
            return redirect('presences')->with('error', 'De competitieleider heeft geen rondes aangemaakt, je kunt nog geen aanwezigheid opgeven.');
        }

        return Inertia::render('Presences/Create')->with('round_dates', $rounds);
    }

    public function singleCreateAdmin()
    {
        $users = User::select(['id', 'name'])->get();
        $rounds = Round::select('date')->orderBy('date')->get();
        if ($rounds->isEmpty()) {
            return redirect('presences')->with('error', 'De competitieleider heeft geen rondes aangemaakt, je kunt nog geen aanwezigheid opgeven.');
        }

        return Inertia::render('Admin/Presences/Create')->with('round_dates', $rounds)->with('users', $users);
    }

    public function storeAdmin(StorePresenceRequest $request)
    {
        if (Auth::user()->hasRole('competitionleader')) {
            $validatedPresenceRequest = $request->validated();


            if (!isset($validatedPresenceRequest['change'])) {
                $date = $validatedPresenceRequest['date'];

                //format the date to determine the round

                $date = $date . " 00:00:00";
                $round = Round::where('date', $date)->get();

                // Gates to pass for actually processing
                // 1. A round is necessary, 2. The Round should not be processed 3. The round should not be in the past.
                if ($round->isEmpty()) {
                    return redirect('/admin/presences')->with('error', 'Op de datum die je hebt geselecteerd, is er geen ronde!');
                }

                if ($round[0]->processed == 1) {
                    return redirect('/admin/presences')->with('error', 'Voor deze ronde kun je je aanwezigheid niet meer wijzigen!');
                }
                if (Round::lastProcessedRound() !== NULL) {
                    if ($round[0]->date <= Round::lastProcessedRound()->date) {
                        return redirect('/admin/presences')->with('error', 'De ronde waarvoor je een aanwezigheid wilt opgeven is al verwerkt!');
                    }
                }
            } else {
                $round = Round::where('id', $validatedPresenceRequest['round'])->get();
            }
            $user = $validatedPresenceRequest['user_form'];

            // Check if a presence exists; If so, it can be change.
            $presence_exist = Presence::where([['user_id', '=', $user], ['round', '=', $round[0]->id]])->get();

            // Availability == 1, so we are present
            if ($validatedPresenceRequest['availability'] == 1) {
                // No presence exist, so we need to create one.
                if ($presence_exist->isEmpty()) {
                    $presence = new Presence;
                    $presence->user_id = $user;
                    $presence->round = $round[0]->id;
                    $presence->club_id = $round[0]->club_id;
                    $presence->presence = 1;
                    $presence->save();
                } elseif (
                    $validatedPresenceRequest['availability'] == 1 && $presence_exist[0]->presence == 0
                    && $validatedPresenceRequest['change'] == 1
                ) {
                    // Absence Game Deletion
                    $presence_exist->toQuery()->update(['presence' => '1']);

                    $game = Game::where('white', $user)->where('round_id', $validatedPresenceRequest['round'])->delete();
                } else {
                    return redirect('/admin/presences')->with('error', 'Er is voor deze datum al opgegeven dat de speler aanwezig is. Wilde je de speler afwezig melden?');
                }
            } else {
                if ($presence_exist->isEmpty()) {
                    $presence = new Presence;
                    $presence->user_id = $user;
                    $presence->round = $round[0]->id;
                    $presence->club_id = $round[0]->club_id;
                    $presence->presence = 0;
                    $presence->save();

                    // Absence Game Creation
                    $game = new Game;
                    $game->white = $user;
                    $game->result = "Afwezigheid";
                    $game->round_id = $round[0]->id;
                    $game->club_id = $round[0]->club_id;
                    $game->black = $validatedPresenceRequest['reason'];
                    $game->save();
                } elseif (
                    $validatedPresenceRequest['availability'] == 0 && $presence_exist[0]->presence == 1
                    && $validatedPresenceRequest['change'] == 1
                ) {
                    // Absence Game Creation
                    $presence_exist->toQuery()->update(['presence' => '0']);

                    $game = new Game;
                    $game->white = $user;
                    $game->result = "Afwezigheid";
                    $game->round_id = $round[0]->id;
                    $game->club_id = $round[0]->club_id;
                    $game->black = $validatedPresenceRequest['reason'];
                    $game->save();
                } else {
                    return redirect('/admin/presences')->with('error', 'Er is voor deze datum al opgegeven dat de speler afwezig is. Wilde je de speler aanwezig melden?');
                }
            }

            return redirect('/admin/presences')->with('success', 'Je hebt de aan-/afwezigheid op de juiste wijze doorgegeven!');
        }
        return redirect('/')->with('error', 'Je hebt hier geen rechten voor');
    }

    public function store(StorePresenceRequest $request)
    {
        $validatedPresenceRequest = $request->validated();


        if (!isset($validatedPresenceRequest['change'])) {
            $date = $validatedPresenceRequest['date'];

            //format the date to determine the round

            $date = $date . " 00:00:00";
            $round = Round::where('date', $date)->get();

            // Gates to pass for actually processing
            // 1. A round is necessary, 2. The Round should not be processed 3. The round should not be in the past.
            if ($round->isEmpty()) {
                return redirect('presences')->with('error', 'Op de datum die je hebt geselecteerd, is er geen ronde!');
            }

            if ($round[0]->processed == 1) {
                return redirect('presences')->with('error', 'Voor deze ronde kun je je aanwezigheid niet meer wijzigen!');
            }
            if (Round::lastProcessedRound() !== NULL) {
                if ($round[0]->date <= Round::lastProcessedRound()->date) {
                    return redirect('presences')->with('error', 'De ronde waarvoor je een aanwezigheid wilt opgeven is al verwerkt!');
                }
            }
        } else {
            $round = Round::where('id', $validatedPresenceRequest['round'])->get();
        }
        $user = Auth::user();

        // Check if a presence exists; If so, it can be change.
        $presence_exist = Presence::where([['user_id', '=', $user->id], ['round', '=', $round[0]->id]])->get();

        // Availability == 1, so we are present
        if ($validatedPresenceRequest['availability'] == 1) {
            // No presence exist, so we need to create one.
            if ($presence_exist->isEmpty()) {
                $presence = new Presence;
                $presence->user_id = $user->id;
                $presence->round = $round[0]->id;
                $presence->club_id = $user->club_id;
                $presence->presence = 1;
                $presence->save();
            } elseif (
                $validatedPresenceRequest['availability'] == 1 && $presence_exist[0]->presence == 0
                && isset($validatedPresenceRequest['change'])
            ) {
                // Absence Game Deletion
                $presence_exist->toQuery()->update(['presence' => '1']);

                $game = Game::where('white', $user->id)->where('round_id', $validatedPresenceRequest['round'])->delete();
            } else {
                return redirect('presences')->with('error', 'Je hebt voor deze datum al opgegeven dat je afwezig bent. Wilde je jezelf aanwezig melden? Gebruik het potloodje!');
            }
        } else {
            if ($presence_exist->isEmpty()) {
                $presence = new Presence;
                $presence->user_id = $user->id;
                $presence->round = $round[0]->id;
                $presence->club_id = $user->club_id;
                $presence->presence = 0;
                $presence->save();

                // Absence Game Creation
                $game = new Game;
                $game->white = $user->id;
                $game->result = "Afwezigheid";
                $game->round_id = $round[0]->id;
                $game->club_id = $user->club_id;
                $game->black = $validatedPresenceRequest['reason'];
                $game->save();
            } elseif (
                $validatedPresenceRequest['availability'] == 0 && $presence_exist[0]->presence == 1
                && isset($validatedPresenceRequest['change'])
            ) {
                // Absence Game Creation
                $presence_exist->toQuery()->update(['presence' => '0']);

                $game = new Game;
                $game->white = $user->id;
                $game->result = "Afwezigheid";
                $game->round_id = $round[0]->id;
                $game->club_id = $user->club_id;
                $game->black = $validatedPresenceRequest['reason'];
                $game->save();
            } else {
                return redirect('presences')->with('error', 'Je hebt voor deze datum al opgegeven dat je aanwezig bent. Wilde je jezelf afwezig melden? Gebruik het potloodje!');
            }
        }

        return redirect('presences')->with('success', 'Je hebt je aan-/afwezigheid op de juiste wijze doorgegeven!');
    }

    public function patch(Presence $presence_id)
    {
        if ($presence_id->user_id !== Auth::user()->id) {
            return redirect('presences')->with('error', 'Niet jouw aanwezigheid om aan te passen');
        }
        if (Round::lastProcessedRound() !== NULL) {
            if ($presence_id->date()->select('date')->get()[0]->date < Round::lastProcessedRound()->date) {
                return redirect('presences')->with('error', 'Deze aanwezigheid kun je niet meer aanpassen.');
            }
        }
        $Round = Round::find($presence_id->round);

        return Inertia::render('Presences/Edit')->with('Presence', $presence_id)->with('Round', $Round->round);
    }

    public function patchAdmin(Presence $presence_id)
    {
        if (!Auth::user()->hasRole('competitionleader')) {
            return redirect('/admin/presences')->with('error', 'Niet jouw aanwezigheid om aan te passen');
        }
        if (Round::lastProcessedRound() !== NULL) {
            if ($presence_id->date()->select('date')->get()[0]->date < Round::lastProcessedRound()->date) {
                return redirect('/admin/presences')->with('error', 'Deze aanwezigheid kun je niet meer aanpassen.');
            }
        }
        return Inertia::render('Admin/Presences/Edit')->with('Presence', $presence_id);
    }
}
