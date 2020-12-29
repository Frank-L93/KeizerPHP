<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FirstTimeLogin
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
    public function handle($event)
    {
        if($event->user->firsttimelogin == NULL)
        {
            session()->put('firstTime', '1');
            $user = User::findorfail($event->user->id);
            $user->firsttimelogin = 1;
            $user->save();
        }
    }
}
