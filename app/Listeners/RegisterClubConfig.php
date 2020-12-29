<?php

namespace App\Listeners;


use App\Events\ClubOwnerCreated;
use App\Models\Club;
use App\Models\Config;
use Carbon\Carbon;

class RegisterClubConfig
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
     * @param \App\Events\ClubOwnerCreated $event
     *
     * @return void
     */
    public function handle(ClubOwnerCreated $event)
    {

        $club = Club::find($event->club->id);
        Config::create([
            'RoundsBetween_Bye' => '5',
            'RoundsBetween' => '5',
            'Club' => '0.25',
            'Personal' => '0.25',
            'Bye' => '1',
            'Presence' => '0.1',
            'Other' => '0.25',
            'Start' => '60',
            'Step' => '1',
            'Name' => $club->name,
            'Season' => Carbon::now()->year,
            'Admin' => $event->user->id,
            'EndSeason' => '0',
            'announcement' => '',
            'AbsenceMax' => '3',
            'SeasonPart' => '13',
            'club_id' => $club->id,
        ]);

    }
}
