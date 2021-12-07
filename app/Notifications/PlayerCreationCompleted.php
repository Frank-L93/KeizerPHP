<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlayerCreationCompleted extends Notification
{
    use Queueable;

    public $user;

    public $password;
    /**
     * Create a new notification instance.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Club $club
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->greeting('Welcome!')
            ->line('Hi '.$this->user->name.'! De competitieleider van jouw vereniging heeft voor jou een account aangemaakt op KeizerPHP.nl')
            ->line('Met dit account kun je meedoen aan de Keizercompetitie van jouw vereniging. Log in en geef je beschikbare speelavonden op zodat je ingedeeld kunt worden.')
            ->line('Je eerste wachtwoord is: '.$this->password.' Er wordt aangeraden om dit wachtwoord na inloggen aan te passen.')
            ->action('Geef je beschikbaarheid op', url('/'))
            ->line('Succes!');
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
