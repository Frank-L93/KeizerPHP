<?php

namespace App\Notifications;

use App\Models\Club;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClubCreationCompleted extends Notification
{
    use Queueable;

    public $club;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Club $club
     */
    public function __construct(Club $club)
    {
        $this->club = $club;
        $this->name = 'ClubCreation';
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
            ->subject($this->club->name . ' is nu geregistreerd bij KeizerPHP')
            ->markdown('emails.newAccount.competitionleader', ['club' => $this->club, 'url' => env('APP_URL') . '/activate/club/' . $this->club->id . '/' . $this->club->token]);
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
