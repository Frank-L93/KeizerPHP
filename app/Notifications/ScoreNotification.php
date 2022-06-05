<?php

namespace App\Notifications;

use App\Events\GameUpdating;
use App\Models\Round;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ScoreNotification extends Notification
{
    use Queueable;

    public $event;
    public $black;
    public $scoringtext;
    public $opponnent;
    public $type;
    public $round;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(GameUpdating $event, Round $round, $scoringtext, $black, $opponnent, $type)
    {
        $this->event = $event;
        $this->black = $black;
        $this->scoringtext = $scoringtext;
        $this->opponnent = $opponnent;
        $this->type = $type;
        $this->round = $round;

        //        dd($this->event, $this->black, $this->opponnent, $this->type);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return $this->type;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (intval($this->black == 0)) {
            if ($this->opponnent == 2) {
                return (new MailMessage)->subject('Uitslag ronde ' . $this->round->round)->markdown('emails.games.scoreBye', ['round' => $this->round->round, 'gamescore' => $this->scoringtext]);
            }
        } else {
            return (new MailMessage)->subject('Uitslag ronde ' . $this->round->round)->markdown('emails.games.score', ['round' => $this->round->round, 'opponnent' => $this->opponnent->name, 'gamescore' => $this->scoringtext]);
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if (intval($this->black == 0)) {
            if ($this->opponnent == 2) {
                return [
                    'round' => $this->round->round,
                    'opponnent' => "Bye of aanwezigheid",
                    'gamescore' => $this->scoringtext,
                    'special' => 1,
                ];
            } else {
                return [''];
            }
        } else {
            return [
                'round' => $this->round->round,
                'opponnent' => $this->opponnent,
                'gamescore' => $this->scoringtext,
                'special' => 0,
            ];
        }
    }
}
