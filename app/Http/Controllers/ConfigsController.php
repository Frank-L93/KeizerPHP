<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
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

        $configs->save();

        return Inertia::render('Admin/Configs/Index')->with('success', 'Opgeslagen!');
    }
}
