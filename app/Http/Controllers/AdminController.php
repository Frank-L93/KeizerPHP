<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Config;

class AdminController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        $users = User::all();
        $rounds = Round::all();
        $rankings = Ranking::all();
        $presences = Presence::all();
        $games = Game::all();
        return view('admin.index')->with(['configs' => $configs, 'users' => $users, 'rounds' => $rounds, 'rankings' => $rankings, 'presences' => $presences, 'games' => $games]);
    }
}
