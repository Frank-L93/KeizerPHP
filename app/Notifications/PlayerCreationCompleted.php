<?php

namespace App\Notifications;

use App\Models\Club;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PlayerCreationCompleted extends Notification
{
    use Queueable;

    public $user;
    public $name;
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
        $this->name = 'PlayerCreation';
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
        $club = Club::find($this->user->club_id)->firstOrFail();
        return (new MailMessage)
            ->subject('Uitnodiging voor het competitiesysteem van ' . $club->name)
            ->markdown('emails.newAccount.user', ['user' => $this->user, 'password' => $this->password, 'url' => '/activate/' . $this->user->email . '/' . $this->user->id]);
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
