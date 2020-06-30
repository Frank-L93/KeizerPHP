<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use App\User;
use App\Ranking;
use App\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PushDemo extends Notification
{
    use Queueable;

    var $message;
    var $title;
    var $type;
    var $Database_Title;
    var $Database_Message;
    var $subject;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message, string $title, $type)
    {
        $this->message = $message;
        $this->title = $title;
        $this->type = $type;
       
        if($this->type == "1")
        {
            $this->subject = "Update!";
            $this->Database_Title = "Stand";
            $this->Database_Message = "Er is een nieuwe stand!";
            $this->Type_Text = "Bekijk de volledige stand!";
            $this->Type_Action = "rankings";
        }
        elseif($this->type == "2")
        {
            $this->subject = "Update!";
            $this->Database_Title = "Partijen";
            $this->Database_Message = "Er zijn nieuwe partijen!";
            $this->Type_Text = "Bekijk alle partijen!";
            $this->Type_Action = "games";
        }
        elseif($this->type == "3"){
            $this->subject = "Update!";
            $this->Database_Title = "Admin-notificatie";
            $this->Database_Message = "Er vereist een attentie van een Admin";
            $this->Type_Text = "Ga naar de adminsite!";
            $this->Type_Action = "admin";
        }
        elseif($this->type == "4")
        {
            $this->title = "Activatiemail";
            $this->subject = "Activeer!";
            $this->message = "Je kunt je account activeren via de button of met deze code: ".$message;
            $this->Type_Text = "Activeer je account!";
            $this->Type_Action = "activation/".$message."/".$title;
        }

      
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Determine the kind of notification that needs to be send for the notifiable.
        // Each notifiable has settings with the name 'notifications'.
        // 1 -> Mail 2 -> Mail & Push Alert 3 -> Push Alert 4 -> SMS? 5 -> Database
        // 0 -> none
        if($this->type == "4")
        {
            return ['mail'];
        }

        if($notifiable->settings()->get('notifications') == 1)
        {
            return ['mail', 'database'];
        }
        elseif($notifiable->settings()->get('notifications') == 2)
        {
            return [WebPushChannel::class, 'mail', 'database'];
        }
        elseif($notifiable->settings()->get('notifications') == 3)
        {
            return [WebPushChannel::class, 'database'];
        }
        elseif($notifiable->settings()->get('notifications') == 4)
        {
            return ['NexMo', 'database'];
        }
        elseif($notifiable->settings()->get('notifications') == 5)
        {
            return ['database'];
        }
       
       
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon('/notification-icon.png')
            ->body($this->message)
            ->action('View App', 'notification_action');
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    { 
        if($this->type == "1")
        {
            $data = Ranking::orderBy('score', 'desc')->orderBy('value', 'desc')->take(3)->get();
        }
        elseif($this->type == "2")
        {
          
            $game = Game::where('white', $notifiable->id)->orWhere('black', $notifiable->id)->latest()->first();
            
            $white = User::select('name')->where('id', $game->white)->first();
          
            if($game->black == "Bye" || $game->result == "Afwezigheid")
            {
                
                $black = "Bye of Afwezigheid";
            }
            else
            {
                $black = User::select('name')->where('id', $game->black)->first();
                $black = $black->name;
            }
            $data = Array();
            array_push($data, ["white" => $white->name, "black"=>$black]);
            
        }
        else{
            $data = "";
        }
        return (new MailMessage)
                    ->greeting($this->subject)
                    ->subject('De Pion '.$this->title)
                    ->line($this->message)
                    ->action($this->Type_Text, url($this->Type_Action))
                    ->markdown('vendor.notifications.email', ['data' => $data]);
                    
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
            "Title"=>$this->Database_Title,
            "Message"=>$this->Database_Message,
        ];
    }
}
