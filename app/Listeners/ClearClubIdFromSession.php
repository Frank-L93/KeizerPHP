<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ClearClubIdFromSession
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        session()->forget('club_id');
        session()->forget('firstTime');
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
