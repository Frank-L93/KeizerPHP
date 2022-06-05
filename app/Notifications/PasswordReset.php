<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    public $name;
    public $user;

    public $password;
    /**
     * Create a new notification instance.
     *
     * @param \App\Models\User $user
     * @param $password
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->name = "PasswordReset";
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->line('Hi ' . $this->user->name . '! Jij hebt of de competitieleider van jouw vereniging heeft voor jou een nieuw wachtwoord aangevraagd')
            ->line('Je nieuwe wachtwoord is: ' . $this->password . ' Er wordt aangeraden om dit wachtwoord na inloggen aan te passen.')
            ->action('Ga hier naar toe om in te loggen', url('activate/' . $this->user->id . '/' . $this->user->activate))
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
