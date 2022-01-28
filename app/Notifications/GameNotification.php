<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Events\GameSaving;
use App\Models\Round;
use Carbon\Carbon;

class GameNotification extends Notification
{
    use Queueable;

    public $event;
    public $black;
    public $opponnent;
    public $type;
    public $round;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(GameSaving $event, Round $round, $black, $opponnent, $type)
    {
        $this->event = $event;
        $this->black = $black;
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
        $date = $this->round->date;
        Carbon::setLocale('nl_NL');
        $dateFormatted = Carbon::parse($date)->timezone('Europe/Amsterdam')->isoFormat('D MMMM YYYY');

        if (intval($this->black == 0)) {
            if ($this->opponnent == 2) {
                return (new MailMessage)->subject('Indeling voor ' . $dateFormatted . ' bekend')->markdown('emails.games.bye', ['round' => $this->round->round]);
            }
        } else {
            return (new MailMessage)->subject('Indeling voor ' . $dateFormatted . ' bekend')->markdown('emails.games.new', ['round' => $this->round->round, 'opponnent' => $this->opponnent->name]);
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
                    'special' => 1,
                ];
            } else {
                return [''];
            }
        } else {
            return [
                'round' => $this->round->round,
                'opponnent' => $this->opponnent,
                'special' => 0,
            ];
        }
    }
}
