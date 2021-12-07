<?php


namespace App\Listeners;


use App\Events\PlayerCreated;
use App\Events\UserCreated;
use App\Models\Club;
use App\Models\User;
use App\Notifications\PlayerCreationCompleted;


class RegisterPlayer
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
     * @param PlayerCreated $event
     * @param String $password
     *
     * @return void
     */
    public function handle(PlayerCreated $event)
    {
        // Assign the role for the player.
        $event->user->assignRole('player');

        // Create the first settings for the player
        // This is an event to which the RegisterSettings is listening.
        event(new UserCreated($event->user));

        // Notify the player.
        $event->user->notify(new PlayerCreationCompleted($event->user, $event->password));
    }
}
