<?php

namespace App\Listeners;

use App\Models\Round;
use App\Models\User;
use App\Notifications\ScoreNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GameUpdating
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

        $text_White = match ($event->game->result) {
            '1-0' => 'gewonnen',
            '0.5-0.5' => 'remise gespeeld',
            '0-1' => 'verloren',
            'Afwezigheid' => 'Afwezigheid',
            default => 'nog geen resultaat',
        };
        $text_Black = match ($event->game->result) {
            '1-0' => 'verloren',
            '0.5-0.5' => 'remise gespeeld',
            '0-1' => 'gewonnen',
            default => 'nog geen resultaat',
        };

        $round = Round::find($event->game->round_id);
        $white = $event->game->white;
        $user_white = User::find($white);

        $black = 0;
        $user_black = 2;
        if ($event->game->black == "Bye" || $event->game->result == "Afwezigheid") {
        } else {
            $black = $event->game->black;
        }
        if ($black !== 0) {
            $user_black = User::find($black);
            if ($user_black->hasSettings->notifications == true) {
                // Check what kind of notifications are necessary
                if ($user_black->hasSettings->NotifyByMail == true) {
                    // Sent Notification Per Mail

                    $user_black->notify(new ScoreNotification($event, $round, $text_Black, $black, $user_white, "Mail"));
                }
                if ($user_black->hasSettings->NotifyByDB == true) {
                    $user_black->notify(new ScoreNotification($event, $round, $text_Black, $black, $user_white, "Database"));
                }
                if ($user_black->hasSettings->NotifyByRSS == true) {
                    // Sent Notification Per RSS
                    //$user_black->notify(new GameNotification($event, $round, $black, $user_white, "RSS"));
                }
            }
        }

        if ($user_white->hasSettings->notifications == true) {

            // Check what kind of notifications are necessary
            if ($user_white->hasSettings->NotifyByMail == true) {

                // Sent Notification Per Mail
                $user_white->notify(new ScoreNotification($event, $round, $text_White, $black, $user_black, "Mail"));
            }
            if ($user_white->hasSettings->NotifyByDB == true) {
                $user_white->notify(new ScoreNotification($event, $round, $text_White, $black, $user_black, "Database"));
            }
            if ($user_white->hasSettings->NotifyByRSS == true) {
                // Sent Notification Per RSS
                // $user_white->notify(new GameNotification($event, $round, $black, $user_black, "RSS"));
            }
        }


        app('log')->info($event->game);
    }
}
