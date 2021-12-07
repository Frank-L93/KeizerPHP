<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    /*
    * The Ranking Model defines the rank of a player
    * It therefore has an Player ID, it contains the score, the value, the last value and the semilast value.
    * A ranking also has the color score, the amount of games played, the sum of the rating of players, the TPR and the gamescore.
    */

    // The ranking belongs to a user.
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
