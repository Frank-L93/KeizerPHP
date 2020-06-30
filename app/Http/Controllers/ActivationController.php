<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PushController;

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
            $user->activate = $activation_key;
            $user->save();
            $a = new PushController();
            return $a->push('Activation', $activation_key, $request->input('email'), '4');
        }
        return view('activation.index')->with('error', 'Opgegeven emailadres is niet gekoppeld aan een account. Je kunt dus niet activeren met dit emailadres');
    }

    public function activate($activate, $email)
    {
        $users = User::where('email', $email)->get();
        foreach($users as $user)
        {
            if($user->activate == $activate)
            {
                $user->active = 1;
                $user->activate = 0;
                $user->settings = ["notifications"=>"1"];
                $user->save();
                return redirect()->route('login')->with('success', 'Je bent actief. Je kunt nu inloggen. Pas je wachtwoord aan in je instellingen.');
            }
        }
        return view('pages.index')->with('error', 'Er ging iets mis bij de activatie. Klopte je link wel?');
    }
}
