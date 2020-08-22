<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Presence;
use App\Round;
use App\User;
Use App\Ranking;
Use App\Game;
Use App\Settings;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $settings = settings()->all();
        return view('settings.index')->with("user", $user)->with("settings", $settings);
    }

    // Password Change function
    public function changePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Je huidige wachtwoord klopt niet.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Het nieuwe wachtwoord mag niet hetzelfde zijn als het oude wachtwoord.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Wachtwoord succesvol gewijzigd!");

    }

    public function changeEmail(Request $request){
        if(!(Hash::check($request->get('password'), Auth::user()->password))){
            return redirect()->back()->with("error", "Email niet gewijzigd, je wachtwoord is onjuist!");
        }
        if(strcmp($request->get('email'), Auth::user()->email) ==0)
        {
            return redirect()->back()->with("error", "Emailadres is niet anders dan het huidige emailadres.");
        }
        $validatedData = $request->validate([
            'password'=>'required',
            'email' => 'required|email:rfc,strict,dns,filter'
        ]);

        $user = Auth::user();
        $user->email = $request->get('email');
        $user->save();
        return redirect()->back()->with("success", "Emailadres succesvol gewijzigd!");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'settings' => 'required',
            'id' => 'required'
        ]);

        $user = Auth::user();
        if($user->id != $request->get('id'))
        {
            return redirect()->back()->with("Error", "Fatale error!");
        }
        
        // Games
        if(settings()->has('games'))
        {
            settings()->set('games', $request->get('games'));
        }
        else
        {
            settings()->merge('games',$request->get('games'));
        }
        
        // Games
        if(settings()->has('ranking'))
        {
            settings()->set('ranking', $request->get('ranking'));
        }
        else
        {
            
            settings()->merge('ranking', $request->get('ranking'));
        }

        // Notifications
        if(settings()->has('notifications'))
        {
            settings()->set('notifications', $request->get('notifications'));
        }
        else
        {
            settings()->merge('notifications',$request->get('notifications'));
        }

        // RSS-Feed
        if(settings()->has('rss'))
        {
            if(settings()->get('rss') == 0)
            {
                $user = Auth::user();
                if($user->api_token == NULL)
                {
                    $user->api_token = Str::random(10);
                    $user->save();
                }
            }
            settings()->set('rss', $request->get('rss'));
            
        }
        else
        {
            $user = Auth::user();
            if($request->get('rss') == 0)
            {
                $user->api_token = NULL;
                $user->save();
            }
               
            if($user->api_token == NULL)
            {
                $user->api_token = Str::random(10);
                $user->save();
            }
            settings()->merge('rss',$request->get('rss'));
        }

        // Layout
        if(settings()->has('layout'))
        {
            settings()->set('layout', $request->get('layout'));
        }
        else
        {
            settings()->merge('layout',$request->get('layout'));
        }
        return redirect()->back()->with('success', 'Voorkeuren aangepast!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
