<?php

namespace App\Providers;

use App\Events\ClubCreated;
use App\Events\PlayerCreated;
use App\Events\ClubOwnerCreated;
use App\Events\GameSaving;
use App\Events\UserCreated;
use App\Listeners\ClearClubIdFromSession;
use App\Listeners\FirstTimeLogin;
use App\Listeners\RegisterClubConfig;
use App\Listeners\RegisterClubOwner;
use App\Listeners\RegisterSettings;
use App\Listeners\SetClubIdInSession;
use App\Listeners\RegisterPlayer;
use App\Listeners\ProcessNotifications;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ClubCreated::class => [
            RegisterClubOwner::class,
        ],
        UserCreated::class => [
            RegisterSettings::class,
        ],
        ClubOwnerCreated::class => [
            RegisterClubConfig::class,
        ],
        Login::class => [
            SetClubIdInSession::class,
            FirstTimeLogin::class,
        ],
        Logout::class => [
            ClearClubIdFromSession::class,
        ],
        PlayerCreated::class => [
            RegisterPlayer::class,
        ],
        GameSaving::class => [
            'App\Listeners\GameSaving',
        ],
        'Illuminate\Notifications\Events\NotificationSent' =>
        [
            ProcessNotifications::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
