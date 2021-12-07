<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Round extends Model
{
    use HasFactory;

    /*
    * A round has a Round Number (round), a date and an identifier if it is processed
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'round', 'date', 'uuid',
    ];
    // Table Name
    protected $table = 'rounds';

    // // Relation with User
    // public function presences()
    // {
    //     return $this->hasMany('App\Presence');
    // }
    // public function games()
    // {
    //     return $this->hasMany('App\Game');
    // }

    public function date()
    {
        return $this->date;
    }

    public static function veryFirstRound()
    {
        $veryFirstRound = Round::select('uuid')->first();
        if ($veryFirstRound == null) {
            return "NoRound";
        }
        return $veryFirstRound;
    }
    public static function firstRound()
    {

        $firstRound = Round::where('processed', NULL)->orderBy('date')->first();
        return $firstRound;
    }


    public static function lastRound()
    {

        $lastRound = Round::where('processed', NULL)->orderBy('date', 'DESC')->first();
        return $lastRound;
    }

    public static function currentRound()
    {
        $now = now();
        $currentRound = Round::where('date', '>=', $now)->orderBy('date')->first();
        return $currentRound;
    }

    public static function lastProcessedRound()
    {
        $lastRound = Round::where('processed', 1)->orderBy('date', 'DESC')->first();
        return $lastRound;
    }

    protected static function booted()
    {
        static::addGlobalScope(new ClubScope);

        static::creating(function ($model) {
            if (session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
            $model->uuid = Str::uuid();
        });


        static::updating(function ($model) {
            if (session()->has('club_id')) {
                $model->club_id = session()->get('club_id');
            }
            $model->uuid = Str::uuid();
        });
    }
}
