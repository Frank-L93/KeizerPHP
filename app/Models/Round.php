<?php

namespace App\Models;

use App\Scopes\ClubScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'round', 'date',
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
