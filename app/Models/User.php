<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * A user is a player, therefore it has some extraordinary characteristics, namely
     * Rating, Availability (beschikbaar) and KNSB_ID
     * A user also has his own settings, and user can be either active or needs to become active (therefore is activate)
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'knsb_id','rating','club_id','beschikbaar','active','activate','rechten',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function settings()
    {
        $settings = Setting::where('user_id', auth()->id())->first();
        return $settings;
    }

    protected static function booted()
    {
        if (auth()->check()) {
            static::addGlobalScope(new ClubScope);
        }
        static::creating(function($model) {
            if(session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
        });
    }
}
