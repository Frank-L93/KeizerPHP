<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use \Awobaz\Compoships\Compoships;
    //
    public function user()
    {
        return $this->belongsTo('App\User', ['white', 'black'], 'id');
    }

    // Relation with Round
    public function rounds()
    {
        return $this->belongsTo('App\Round');
    }
}
