<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Models\Setting;
use App\Rules\MatchCurrentPassword;
use App\Rules\NoMatchCurrentPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use  Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;



class Settings extends Component
{
   /**
    * Variables to change the email
    * $email & $emailPassword
    * MatchCurrentPassword needs to be true
    */
    /** @var string */
    public $emailPassword;

    /** @var string */
    public $email;

    /** @var string */
    public $password;

    /** @var string */
    public $newPassword;

    /** @var string */
    public $passwordConfirmation;

    /** @var User */
    public User $user;

    /** @var array */
    public $settings;
    public $games;
    public $gameOptions;
    public $rankingOptions;
    public $ranking;
    public $notifications;
    public $notificationOptions;
    public $rss;
    public $rssOptions;
    public $rss_link;
    public $layout;
    public $layoutOptions;
    public $language;
    public $languageOptions;

    // To give input to the view.
    public function mount()
    {
        $this->user = Auth::user();
        $this->settings = $this->user->settings();
        $this->email = $this->user->email;
        $this->rss_link = $this->user->api_token;
        $this->games = $this->settings->games;
        $this->ranking = $this->settings->ranking;
        $this->notifications = $this->settings->notifications;
        $this->rss = $this->settings->notifications;
        $this->layout = $this->settings->layout;
        $this->language = $this->settings->language;
        $this->gameOptions = [
            0 => trans('pages.settings.allGames') ,
            1 => trans('pages.settings.ownGames'),
        ];
        $this->rankingOptions = [
            0 =>  trans('pages.settings.notfullRanking'),
            1 => trans('pages.settings.fullRanking'),
        ];
        $this->notificationOptions = [
            0 => trans('pages.settings.noNotifications'),
            1 => trans('pages.settings.notificationsMS'),
            2 => trans('pages.settings.notificationsMPS'),
            3 => trans('pages.settings.notificationsPS'),
            4 => trans('pages.settings.notificationsSMS'),
            5 => trans('pages.settings.notificationsSite'),
        ];
        $this->rssOptions = [
            0 => trans('pages.settings.yesrss'),
            1 => trans('pages.settings.norss'),
        ];
        $this->layoutOptions = [
            "app" => trans('pages.settings.standard'),
            "blue" => trans('pages.settings.blue'),
        ];
        $this->languageOptions =
        [
            "nl" => trans('pages.settings.nl'),
            "en" => trans('pages.settings.en'),
        ];
    }

    public function render()
    {
        return view('livewire.auth.settings')->extends('layouts.app');
    }

    // To show the requirement of a new password while typing
    public function updatedNewPassword()
    {
        $validatedData = Validator::make(
            ['newPassword' => $this->newPassword],
            ['newPassword' => 'min:8'],
            ['min' => trans('auth.passwordLength')],
        );
        if($validatedData->fails())
        {
           foreach($validatedData->messages()->getMessages() as $field_name => $messages){
               foreach($messages as $message)
               {
                 $this->alert('error', $message);
               }
           }
        }
    }

    // Change Password
    public function changePassword()
    {
        $CP = new MatchCurrentPassword;
        $NP = new NoMatchCurrentPassword;
            $validatedData = Validator::make(
                ['password' => $this->password, 'newPassword' => $this->newPassword, 'passwordConfirmation' => $this->passwordConfirmation],
                ['password' => ['required', $CP], 'newPassword' => ['required', $NP], 'passwordConfirmation' => ['same:newPassword']],
                ['same' => trans('auth.SameNewPassword')],
            );
            if($validatedData->fails())
            {
                 foreach($validatedData->messages()->getMessages() as $field_name => $messages){
                    foreach($messages as $message)
                    {
                        $this->alert('error', $message);
                    }
                }
            }
            else{
            $user_to_change = Auth::user(); // We change the current Authed user
            $user_to_change->password = Hash::make($this->newPassword); // Of course hash it before saving.
            $user_to_change->save();

            // Send a success message
            $this->alert('success', trans('auth.passwordChange'));

        }
    }

    // Change Email
    public function changeEmail()
    {
        $CP = new MatchCurrentPassword;
         $validatedEM = Validator::make(
                ['email' => $this->email, 'emailPassword' => $this->emailPassword],
                ['email' => ['required', 'email', 'unique:users'], 'emailPassword' => ['required', $CP]],
                ['unique' => trans('auth.emailChangeFail')],
        );
        if($validatedEM->fails()){
            foreach($validatedEM->messages()->getMessages() as $field_name => $messages){
                    foreach($messages as $message)
                    {
                        $this->alert('error', $message);
                    }
                }
        }
        else{

            $user_to_change = Auth::user();
            $user_to_change->email = $this->email;
            $user_to_change->save();
            $this->alert('success', trans('auth.emailChange'));
        }
    }

    public function changeSettings(): \Illuminate\Http\RedirectResponse
    {
        // Eerste test met taalinstellingen:
        if($this->rss == 1)
        {
            if($this->rss_link == NULL)
            {
                    $this->user->api_token = Str::random(10);
                    $this->user->save();
            }
        }
        else{
                $this->user->api_token = NULL;
                $this->user->save();
        }
        Setting::where('user_id', $this->user->id)->update(['notifications'=>$this->notifications, 'games'=>$this->games, 'ranking'=>$this->ranking, 'rss' => $this->rss, 'layout' => $this->layout, 'language' => $this->language]);

        $this->flash('success', 'Je instellingen worden aangepast en gebruikt na een refresh');

        return redirect()->to('/settings');
    }
}
