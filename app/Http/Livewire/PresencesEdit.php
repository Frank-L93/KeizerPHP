<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Presence;
use  Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Validator;
use App\Models\Game;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PresencesEdit extends Component
{

    public $presenceID;
    public $action;
    public $actionHandler;
    public Presence $presence;
    public $reason;

    public function mount($presenceID, $action)
    {
        $this->presenceID = $presenceID;
        $this->action = $action;
        $this->presence = Presence::find($this->presenceID);
        if($this->presence->user_id == auth()->id() || Gate::allows('admin', Auth::user())){
            if($action == "absent")
            {
               $this->actionHandler = 1;
            }
            else{
                $this->actionHandler = 2;
            }
        }
        else{
            $this->alert('error', trans('pages.error.auth'));
            $this->actionHandler = 4;
        }
    }

    public function render()
    {
        return view('livewire.presences-edit')->extends('layouts.app');
    }

    public function absent()
    {
        if($this->presence->user_id == auth()->id() || Gate::allows('admin', Auth::user()))
        {
            $validatedData = Validator::make(
                ['reason' => $this->reason],
                ['reason' => 'required'],
                ['required' => trans('pages.presences.reasonReq')],
            );
            if($validatedData->fails())
            {
                 foreach($validatedData->messages()->getMessages() as $field_name => $messages){
                     foreach($messages as $message)
                    {
                        $this->alert('error', $message);
                    }
                }
            }
            else
            { // No game, you are allowed to absent;
                $games_white = Game::where('round_id', $this->presence->round)->where('white',$this->presence->user_id)->get();
                $games_black = Game::where('round_id', $this->presence->round)->where('black', $this->presence->user_id)->get();
                if($games_white->isEmpty() && $games_black->isEmpty())
                {
                    $game = new Game;
                    $game->white = $this->presence->user_id;
                    $game->result = "Afwezigheid";
                    $game->round_id = $this->presence->round;    
                    $game->black = $this->reason;
                    $game->save();
                    $this->presence->presence = 0;
                    $this->presence->save();
                    
                    $this->alert('success', trans('pages.presences.success'));
                    $this->actionHandler = 3;
                }
                else{ // Clearly he has a game, so he is not allowed to asbent without informing the competition leader. Competition leader can then delete the game and process the absence.
                    $this->alert('error', trans('pages.presences.LateAbsent'));
                    //notify Admin
                    //$this->alert('error', $this->presence->user_id.' wants to absent himself for round '.$this->presence->round.' with reason '.$this->reason);
                    $this->actionHandler = 3;
                }
            }
        }
        else
        {
            $this->alert('error', trans('pages.error.auth'));
            $this->actionHandler = 4;
        }
    }
     public function present()
    {
        if($this->presence->user_id == auth()->id() || Gate::allows('admin', Auth::user()))
        {
                    $game = Game::where([
                        ['round_id', '=', $this->presence->round], 
                        ['white', '=', $this->presence->user_id]
                        ])->get();
                    
                    if($game->isEmpty())
                    {
                        // No game to delete.
                    }
                    else{ // Check if the game is an absence game, that we want to delte.
                        foreach($game as $game_to_delete){
                            if($game_to_delete->result == "Afwezigheid"){
                                    $game_to_delete->delete();
                                    $this->presence->presence = 1;
                                    $this->presence->save();
                                    $this->alert('success', trans('pages.presences.success2'));
                                    $this->actionHandler = 3;
                            }
                            else{ // Not a Absence Game, but another game, but still the player was absence, so this is a bit of weird case, but might be possible?
                                $this->alert('error', trans('pages.presences.errorGame'));
                                 $this->actionHandler = 3;
                            }
                        }
                    }
        }
        else
        {
            $this->alert('error', trans('pages.error.auth'));
            $this->actionHandler = 4;
        }
    }

    public function goBack()
    {
        return redirect()->to('/presences');
    }
}
