<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /*
    * Each game has an unique ID.
    * Each game has a white player (user) and a black player (user)
    * In case of an absence, an user is white while no user is black.
    * Each game has a result (which can be either 1-0, 0.5-0.5, 0-1 or an Absence message)
    * Each game has a relationship to a round.
    * This relationship consists out of the Round ID.
    * A game has one round, while a round may have 0, 1 or more games.
    */

    protected static function booted()
    {
        static::addGlobalScope(new ClubScope);

        static::creating(function($model) {
            if(session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
        });
    }
}
