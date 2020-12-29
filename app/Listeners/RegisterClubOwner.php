<?php

namespace App\Listeners;

use App\Events\ClubCreated;
use App\Events\ClubOwnerCreated;
use App\Events\UserCreated;
use App\Models\Club;
use App\Models\User;
use App\Notifications\ClubCreationCompleted;
use Illuminate\Support\Facades\Hash;

class RegisterClubOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ClubCreated  $event
     *
     * @return void
     */
    public function handle(ClubCreated $event)
    {

        $newUser = User::create([
            'email' => $event->request->Email,
            'name' => $event->request->Contact,
            'password' => Hash::make($event->request->Password),
            'knsb_id' => $event->request->KNSB,
            'rechten' => 2,
            'club_id' => $event->club->id,
            'rating' => $event->request->rating,
            'beschikbaar' => 0,
            'active' => 1,
            'activate' => 0,
        ]);

        $club = Club::find($event->club->id);
        $club->club_owner = $newUser->id;
        $club->save();

        event(new UserCreated($newUser));
        event(new ClubOwnerCreated($newUser, $club));

        $newUser->notify(new ClubCreationCompleted($club));
    }

}
