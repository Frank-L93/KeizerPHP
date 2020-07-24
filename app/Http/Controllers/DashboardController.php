<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Round;
use App\Presence;

class DashboardController extends Controller
{
    //
    public function GameDashBoard()
    {
        $game_data = Game::all();
        return $game_data;
    }

    public function RoundDashBoard()
    {
        $round_data = Round::all();
        return $round_data;
    }

    public function PresenceDashBoard()
    {
        $presence_data = Presence::all();
        return $presence_data;
    }
}
