<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;

class ProcessNotifications
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
     * @param  object  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        if ($event->notification->name == "PasswordReset") {
            // We will now update the specific user.

            $event->notification->user->password = Hash::make($event->notification->password);
            $event->notification->user->save();
            return true;
        }
    }
}
