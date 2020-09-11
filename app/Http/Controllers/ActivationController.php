<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PushController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ActivationController extends Controller
{
    //
    public function index()
    {
       
        return view('activation.index');
    }

    public function send(Request $request)
    {
        $activation_key = rand(100000,999999);
        $users = User::where('email', $request->input('email'))->get();
        foreach($users as $user)
        {
            if($user->active == 1)
            {
                $password = Str::random(10);
                $user->active = 0;
                $user->password = Hash::make($password);
                $user->activate = $activation_key;
                $user->save();
                $a = new PushController();
                $a->push('activation', $password.' & '.$activation_key, $request->input('email'), '4');
                return redirect()->route('activation')->with('success', 'Wachtwoord gereset, check je mail');
                
            }
            return redirect()->route('login')->with('error', 'Je bent niet actief, dus kunt ook geen nieuw wachtwoord aanvragen. Dat heb je waarschijnlijk al gedaan.');
        }
        return view('activation.index')->with('error', 'Opgegeven emailadres is niet gekoppeld aan een account. Je kunt dus niet activeren met dit emailadres');
    }

    public function activate($activate, $email)
    {
        if($activate == 0)
        {
            return redirect()->route('pages.index')->with('error', 'De activatiecode mag nooit 0 zijn!');
        }
        $users = User::where('email', $email)->get();
        foreach($users as $user)
        {
            if($user->activate == $activate)
            {
                $user->active = 1;
                $user->activate = 0;
                $user->save();
                return redirect()->route('login')->with('success', 'Je nieuwe wachtwoord is actief. Je kunt nu inloggen. Pas je wachtwoord aan in je instellingen.');
            }
        }
        return view('pages.index')->with('error', 'Er ging iets mis bij de wachtwoordactivatie. Klopte je link wel?');
    }
}
