<?php

namespace App\Http\Controllers;

use App\Events\ClubCreated;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Club;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ClubController extends BaseController
{

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public function registerClub(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:100', Rule::unique('clubs')],
            'contact' => ['required', 'max:100'],
            'email' => ['required', 'max:100', 'email:rfc,dns', Rule::unique('users')],
            'password' => ['required'],
            'knsb' => ['required', 'numeric'],
            'rating' => ['nullable', 'numeric'],
        ]);
        $newClub = Club::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'token' => Str::random(20),
        ]);

        ClubCreated::dispatch($newClub, $request);
        return Redirect::route('register')->with('success', 'Club aangemaakt. Voor alle details zie de e-mail die verstuurd is naar ' . $request->email);
    }
}
