<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Presence;

class Presences extends Component
{
    use WithPagination;

    public function render()
    {
         $presences = Presence::where('user_id', auth()->id())->orderBy('round')->paginate(10);
        return view('livewire.presences', [
        'presences' => $presences])->extends('layouts.app');
    }
}
