<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * The application's main controller.
     *
     * This controller controls the main pages of the application.
     *
     * It depends on data from the other controllers and models.
     */

    public function index()
    {

        // When this function is called, it will show the index-page based on the fact if the person is logged in or not.

        if (!auth()->check()) {
            return Inertia::render('Guest');
        }
        if (auth()->user()->activate == 1) {
            Auth::logout();
            return redirect('/login')->with('error', 'Jouw account is niet actief. Heb je op de link gedrukt in de mail?');
        }
        $club = Club::where('id', auth()->user()->club_id)->first();
        if ($club->active == false) {
            return redirect('/login')->with('error', 'De vereniging is niet actief. De competitieleider zal nog moeten bevestigen!');
        }
        return Inertia::render('Index');
    }

    public function activate($email, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->email == $email) {
            $user->activate = 0;
            $user->active = 1;
            $user->save();
            return redirect('/login')->with('success', 'Je account is actief, login met je wachtwoord.');
        }
        return redirect('/')->with('error', 'De activatielink behoort niet tot dit e-mailadres.');
    }

    public function activateClub($id, $token)
    {
        $club = Club::where('id', $id)->first();
        if ($club->token == $token) {
            $club->active = true;
            $club->token = "";
            $club->save();
            return redirect('/login')->with('success', 'De club is geactiveerd. Succes met het vervolg proces!');
        }
        return redirect('/')->with('error', 'De club is niet geactiveerd. De token paste niet bij de club.');
    }
    public function dashboard()
    {
        //The index page has a component for the Dashboard and the User  Menu after logging in.

        return Inertia::render('Index');
    }

    public function presences()
    {
        // Show our Presences
        $presences =
            Presence::where('user_id', Auth::user()->id)->get();

        return Inertia::render('Presences/Show')->with('presences', $presences);
    }

    public function settings()
    {

        return Inertia::render('Auth/Settings');
    }

    public function ranking()
    {
        $rankings = Ranking::with('user')->orderBy('score')->get();
        if ($rankings->isEmpty()) {
            return Redirect::route('dashboard')->with('error', 'Er is nog geen ranglijst');
        }
        return Inertia::render('Rankings/Show')->with('Rankings', $rankings);
    }

    public function about()
    {
        return Inertia::render('Specials/about');
    }

    public function aboutUser()
    {
        return Inertia::render('Specials/AboutUser');
    }

    public function clubRegister()
    {
        return Inertia::render('Auth/clubRegister');
    }

    public function help()
    {
        return Inertia::render('Specials/help');
    }
}
