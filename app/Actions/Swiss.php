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
use phpDocumentor\Reflection\Types\Boolean;

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

    // Sort the Ranking Initially
    public function SortInitial($currentRanking)
    {
        return $currentRanking;
    }

    // Sort the Ranking in Point Groups

    // Rule 1
    /**
     * @param mixed $player1 
     * @param mixed $player2 
     * @return bool 
     */
    public function FacingOpponentOnce($player1, $player2): bool
    {
        // Check if game already exists in tournament
        // if found return false;
        return true;
    }

    // Rule 2
    /**
     * @param mixed $player1 
     * @param mixed $player2 
     * @return bool 
     */
    public function FacingOpponentWithSameScore($player1, $player2): bool
    {
        return true;
    }

    //Rule 3
    /**
     * @param mixed $player1 
     * @param mixed $player2 
     * @param mixed $method 
     * @return bool 
     */
    public function FacingOpponentInSecondPartOfGroup($player1, $player2, $method): bool
    {
        // Either on rating or on WP
        return true;
    }

    public function FacingOpponentWithOtherColor($player1, $player2): bool
    {
        return true;
    }
}
