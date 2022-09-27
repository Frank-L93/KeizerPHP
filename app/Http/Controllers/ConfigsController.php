<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Game;
use App\Models\Presence;
use App\Models\Ranking;
use App\Models\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ConfigsController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        return Inertia::render('Admin/Configs/Index')->with('Configs', $configs);
    }

    public function store(Request $request)
    {
        $configs = Config::select()->first();


        $configs->Admin = $request->admin;

        $configs->Season = $request->season;
        $configs->EndSeason = $request->endseason;
        $configs->SeasonPart = $request->seasonpart;

        $configs->AbsenceMax = $request->absencemax;
        $configs->RoundsBetween_Bye = $request->roundsbetweenbye;
        $configs->RoundsBetween = $request->roundsbetween;

        $configs->Step = $request->step;
        $configs->Start = $request->start;

        $configs->Presence = $request->presence;
        $configs->Club = $request->club;
        $configs->Personal = $request->personal;
        $configs->Other = $request->other;
        $configs->Bye = $request->bye;
        $configs->announcement = $request->announcement;
        $configs->presenceOrLoss = $request->presenceOrLoss;

        $configs->save();
        if ($configs->EndSeason == 1) {
            DB::statement("SET foreign_key_checks=0");
            foreach (Ranking::all() as $r) {
                $r->delete();
            }
            foreach (Round::all() as $r) {
                $r->delete();
            }
            foreach (Presence::all() as $p) {
                $p->delete();
            }
            foreach (Game::all() as $g) {
                $g->delete();
            }
            $configs = Config::find(1);
            $configs->EndSeason = 0;
            $configs->save();
            DB::statement("SET foreign_key_checks=1");
        }
        return Inertia::render('Admin/Configs/Index')->with('success', 'Opgeslagen!');
    }
}
