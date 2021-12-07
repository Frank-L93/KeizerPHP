<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordReset as ResetMail;
use App\Events\PlayerCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Admin/Users/Index')->with('Users', $users);
    }

    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isCompetitionLeader()) {
            return Inertia::render('Index')->with('error', 'Niet gerechtigd om dit te doen');
        }

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns'],
            'beschikbaar' => ['required']
        ]);

        $password = $this->randomPassword();


        $user_created = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($password),
            'knsb_id' => $request->knsb_id,
            'club_id' => session()->get('club_id'),
            'rating' => $request->rating,
            'beschikbaar' => $request->beschikbaar,
            'active' => false,
            'activate' => true,
        ]);

        PlayerCreated::dispatch($user_created, $password);
        return redirect('/admin/users')->with('success', 'Speler: ' . $request->name . ' is aangemaakt en op de hoogte gebracht');
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function patch($user)
    {
        $user_to_edit = User::find($user);
        return Inertia::render('Admin/Users/Edit')->with('user', $user_to_edit);
    }

    public function update(Request $request)
    {

        if (Auth::user()->isCompetitionLeader() || Auth::user()->id == $request->id) {


            $User = User::find($request->id);

            $User->name = $request->name;
            $User->email = $request->email;
            $User->knsb_id = $request->knsb_id;
            $User->rechten = $request->rechten;
            $User->rating = $request->rating;
            $User->beschikbaar = $request->beschikbaar;
            $User->firsttimelogin = $request->firsttimelogin;
            $User->active = $request->active;
            $User->activate = $request->activate;

            $User->save();
            return redirect('/admin/users')->with('success', 'Gebruiker ' . $request->id . '(' . $User->name . ') aangepast.');
        }
        return redirect('/')->with('error', 'Niet gerechtigd om dit te doen');
    }

    public function resetPassword(Request $request)
    {
        // We will reset the password of the user with the requested ID;
        if (Auth::user()->isCompetitionLeader()) {
            $newPassword = $this->randomPassword();
            $User = User::find($request->id);

            // ONLY SAVE THE PASSWORD TO THE DB IF THE MAIL HAS BEEN SENT! We will therefore listen for the notification and in the listener we update the password and if sent, we dispatch a new event to redirect?
            $User->notify(new ResetMail($User, $newPassword));

            return redirect('admin/users')->with('success', 'Wachtwoord gewijzigd voor gebruiker ' . $User->id . '. Er is een e-mail gestuurd naar: ' . $User->name . ' (' . $User->email . ').');
        }
        return redirect('/')->with('error', 'Niet gerechtigd om dit te doen');
    }
}
