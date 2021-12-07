<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


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
        return Inertia::render('Index');
    }

    public function dashboard()
    {
        //The index page has a component for the Dashboard and the User  Menu after logging in.

        return Inertia::render('Index');
    }

    public function games()
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
        return Inertia::render('Rankings/Show')->with('Rankings', $rankings);
    }

    public function about()
    {
        return Inertia::render('about');
    }

    public function clubRegister()
    {
        return Inertia::render('Auth/clubRegister');
    }
}
