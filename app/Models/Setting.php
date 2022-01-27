<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * Settings have a relationship to a user
     * For each setting, there is a column in the table Settings
     * So we have Setting::where('user_id',$user)->get('$setting');
     */
    protected $casts =
    [
        'notifications' => 'boolean',
        'NotifyByMail' => 'boolean',
        'NotifyByDB' => 'boolean',
        'NotifyByRSS' => 'boolean',
    ];

    protected $fillable =
    [
        'user_id',
        'notifications',
        'games',
        'ranking',
        'layout',
        'language',
        'club_id',
        'NotifyByMail',
        'NotifyByDB',
        'NotifyByRSS',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new ClubScope);

        static::creating(function ($model) {
            if (session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
        });
    }
}
