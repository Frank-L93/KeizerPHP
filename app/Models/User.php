<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

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
        'knsb_id', 'rating', 'club_id', 'beschikbaar', 'active', 'activate',
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
        'beschikbaar' => 'boolean',
        'active' => 'boolean',
        'activate' => 'boolean',
        'firsttimelogin' => 'boolean',
    ];

    public static function settings()
    {
        $settings = Setting::where('user_id', auth()->id())->first();
        return $settings;
    }

    public function hasSettings()
    {
        return $this->hasOne('App\Models\Setting');
    }

    public function getRSSLink()
    {
        return $this->api_token;
    }

    public function rating()
    {
        return $this->rating;
    }

    public function name()
    {
        return $this->name;
    }


    public function ranking()
    {
        return $this->hasOne('App\Models\Ranking');
    }

    public function isAdmin()
    {
        if ($this->hasRole('super-admin')) {
            return true;
        }
        return false;
    }

    public function isCompetitionLeader()
    {
        if ($this->hasRole('competitionleader')) {
            return true;
        }
        return false;
    }

    protected static function booted()
    {
        if (auth()->check()) {
            static::addGlobalScope(new ClubScope);
        }
        static::creating(function ($model) {
            if (session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
        });
    }
}
