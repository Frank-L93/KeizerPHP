<?php

namespace App\Actions;

use App\Models\Swiss\SwissConfig;
use App\Models\Swiss\SwissGame;
use App\Models\Swiss\SwissRanking;
use App\Models\Swiss\SwissRound;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class Swiss
{
    public function Pair($currentRanking)
    {
        //Loop through the $currentRanking;
        foreach ($currentRanking as $rank) {
            dd($rank);
            // find the next rank and try to pair
            // It is a valid pairing if:
            // No game exists in this Swiss Tournament against that rank
            // Colors don't have a favorite

        }
        return false;
    }

    public function ValidOpponent($rank1, $rank2)
    {
        //Do something with $rank1 and $rank2
        return true;
    }
}
