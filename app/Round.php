<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{

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
   
    // Timestamps
    public $timestamps = true;

    // Relation with User
    public function presences()
    {
        return $this->hasMany('App\Presence');
    }
    public function games()
    {
        return $this->hasMany('App\Game');
    }
}
