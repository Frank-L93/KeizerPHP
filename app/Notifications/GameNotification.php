<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Events\GameSaving;
use App\Models\Round;

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
        return (new MailMessage)
            ->line('Je hebt een nieuwe partij!')
            ->line('De partij van ronde ' . $this->round->round . ' is tegen ' . $this->opponnent->name)
            ->action('Bekijk de volledige indeling hier', url('/'))
            ->line('Tot snel!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
