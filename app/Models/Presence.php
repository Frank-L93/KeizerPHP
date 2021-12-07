<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class Presence extends Model
{
    use HasFactory;

    /*
    * Each Presence represents whether or not a player (user) will be present during a round.
    * It therefore has an relationship to the player, and an relationship to the round
    * A presence can only have one player and one round, while a player can have 0, 1 or more presences.
    * A player can not have multiple presences in a round;
    * A round can have multiple presences.
    * A Presence has also an identifier (Presence) which can be either 1 or 0, meaning it is an Presence or an Absence
    */
    public function user()
    {

        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function date()
    {

        return $this->belongsTo('App\Models\Round', 'round', 'id');
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
