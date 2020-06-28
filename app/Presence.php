<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    // Table Name
    protected $table = 'presences';
   
    // Timestamps
    public $timestamps = true;

    // Relation with User
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Relation with Round
    public function rounds()
    {
        return $this->hasMany('App\Round');
    }
}
