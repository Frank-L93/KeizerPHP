<?php

namespace App\Http\Controllers;

use App\Models\Round;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class RoundsController extends Controller
{
    public function index()
    {
        $rounds = Round::all();
        return Inertia::render('Admin/Rounds/Index')->with('Rounds', $rounds);
    }

    public function create()
    {
        return Inertia::render('Admin/Rounds/Create');
    }
    public function store(Request $request)
    {
        $exist = Round::where('round', $request->round_number)->first();

        if ($exist == NULL) {

            $ronde = Round::create([
                'round' => $request->round_number,
                'date' => $request->date,
            ]);

            return redirect('admin/rounds')->with('success', 'Ronde ' . $ronde->round . ' is aangemaakt voor club ' . $ronde->club_id);
        } else {
            return redirect('admin/rounds/create')->with('error', 'Je hebt ronde ' . $request->round_number . ' al aangemaakt');
        }
    }

    public function destroy(Round $round)
    {
        $round->delete();

        return redirect('admin/rounds')->with('success', 'Ronde verwijderd.');
    }

    public function patch($round)
    {
        $editRound = Round::find($round);
        return inertia::render('Admin/Rounds/Edit')->with('Round', $editRound);
    }

    public function update(Request $request)
    {
        $editingRound = Round::find($request->id);


        $existingRound = Round::where('round', $request->round_number)->get();

        foreach ($existingRound as $round) {
            if ($editingRound->round == $round->round) {
                // updating
                $editingRound->date = $request->date;
                $editingRound->update();
                return redirect('admin/rounds')->with('succes', 'Ronde ' . $editingRound->round . ' aangepast!');
            } else {
                // Round number exists, but not updating the right one, return.
                return redirect('admin/rounds')->with('error', 'Rondenummer al toegewezen');
            }
        }
        $editingRound->date = $request->date;
        $editingRound->round = $request->round_number;
        $editingRound->update();
        return redirect('admin/rounds')->with('succes', 'Ronde ' . $editingRound->round . ' aangepast!');
        // if nog in foreach-loop it is empty so updating is possible.
    }

    public function Data(Request $request)
    {

        $Round = Round::find($request->round);
        return $Round->round;
    }
}
