<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use App\Models\User;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function getCurrentPlayers(): string
    {
        $amount = User::count();
        $amountStandaardbeschikbaar = User::where('beschikbaar', 1)->count();
        return json_encode([$amount, $amountStandaardbeschikbaar]);
    }

    public function top(): string
    {
        $top = Ranking::select('user_id', 'score')->orderBy('score', 'desc')->take(3)->with('user:id,name')->get();
        return json_encode($top);
    }

    public function games(): string
    {
        return "partijen";
    }

    public function tpr(): string
    {
        return "trp";
    }

    public function bestWin(): string
    {
        return "bestwin";
    }
    public function leftRounds(): string
    {
        return "leftRounds";
    }
}
