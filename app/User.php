<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Settings;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use HasPushSubscriptions;
    use Notifiable;
    use \Awobaz\Compoships\Compoships;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','knsb_id','rating','beschikbaar','settings','active','activate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'json',
    ];

    /**
     * Get the user settings.
     *
     * @return Settings
     */

    public function settings()
    {  
        return new Settings($this->settings, $this);
    }

    public function settingsGet(User $user_to_get)
    {
        return new Settings($user_to_get->settings, $user_to_get);
    }
    public function ranking()
    {
        return $this->belongsTo('App\Ranking');
    }

    public function presences()
    {
        return $this->hasMany('App\Presence');
    }

    public function games()
    {
        return $this->hasMany('App\Game', ['white', 'black']);
    }

    public function scopeWithSetting($query, $setting, $value = true)
    {
        return $query->where('settings->' . str_replace('.', '->', $setting), $value);
    }
}
