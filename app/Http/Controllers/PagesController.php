<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use App\Settings;
Use App\Config;
Use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Schema;
use App;

class PagesController extends Controller
{

    public function index(){
        $settings = app('App\Settings');
        if(!is_object($settings))
        {
            $settings_json = json_decode($settings);
            App::setLocale($settings_json->language);
        }
        else
        {
            $settings_json = $settings;
            if($settings_json->has('language'))
            {
                App::setLocale($settings_json->language);
            }
        }
        
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect('/install');
        }
        if((!Schema::hasTable('configs')) || Config::CompetitionName() == "Need Install")
        {
            return redirect('/install');
        }
        config(['app.name' => Config::CompetitionName()]);
        
        if((Auth::check()) && (auth()->user()->active == 0 || auth()->user()->active == NULL))
        {
            $errors = ['activation_response' => 'Je hebt geen actief account. ' . link_to(url('activation'), 'Klik hier') . ' om je account te activeren'];
            Auth::logout();
            return redirect('/login')->withErrors($errors);
           
        }
        elseif((Auth::check()) && (auth()->user()->remember_token == NULL)){
            $user = Auth::user();

            $user->remember_token = 1;
            $user->save();
            return redirect('/settings')->with('success', 'Gelieve eerst je wachtwoord te wijzigen');
        }
        $dashboard = new DashboardController;
        $dashboard_games = $dashboard->GameDashBoard();
        $dashboard_rounds = $dashboard->RoundDashBoard();
        $dashboard_presences = $dashboard->PresenceDashBoard();
        $dashboard_absences = $dashboard->AbsenceDashBoard();
        if($dashboard_rounds == "Geen rondes meer!"){
            return view('pages.index')->with('rounds', $dashboard_rounds);
        }
        return view('pages.index')->with('games', $dashboard_games)->with('rounds', $dashboard_rounds)->with('presences', $dashboard_presences)->with('absences', $dashboard_absences);
    }
    
    public function indexInstall(){
        $settings = app('App\Settings');
        if((!Schema::hasTable('configs')) || Config::CompetitionName() == "Need Install")
        {
            return redirect('/install');
        }
        config(['app.name' => Config::CompetitionName()]);
        
        if((Auth::check()) && (auth()->user()->active == 0 || auth()->user()->active == NULL))
        {
            $errors = ['activation_response' => 'Je hebt geen actief account. ' . link_to(url('activation'), 'Klik hier') . ' om je account te activeren'];
            Auth::logout();
            return redirect('/login')->withErrors($errors);
           
        }
        elseif((Auth::check()) && (auth()->user()->remember_token == NULL)){
            $user = Auth::user();

            $user->remember_token = 1;
            $user->save();
            return redirect('/settings')->with('success', 'Gelieve eerst je wachtwoord te wijzigen');
        }
        $dashboard = new DashboardController;
        $dashboard_games = $dashboard->GameDashBoard();
        $dashboard_rounds = $dashboard->RoundDashBoard();
        $dashboard_presences = $dashboard->PresenceDashBoard();
        $dashboard_absences = $dashboard->AbsenceDashBoard();
        if($dashboard_rounds == "Geen rondes meer!"){
            return view('pages.index')->with('rounds', $dashboard_rounds);
        }
        return view('pages.index')->with('success', 'Installation gelukt')->with('games', $dashboard_games)->with('rounds', $dashboard_rounds)->with('presences', $dashboard_presences)->with('absences', $dashboard_absences);
    }
    
    public function about(){
        return view('pages.about');
    }

    public function privacy(){
        return view('pages.privacy');
    }
   
}
