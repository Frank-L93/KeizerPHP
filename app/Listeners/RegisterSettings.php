<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\Setting;

class RegisterSettings
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {

        // These settings are shared via the Inertia-middleware to all pages, therefore creation of them is mandatory.
        Setting::create([
            'user_id' => $event->user->id,
            'notifications' => 0,
            'games' => 0,
            'ranking' => 0,
            'rss' => 0,
            'layout' => 'standard',
            'language' => 'nl',
            'club_id' => $event->user->club_id,
        ]);
    }
}
