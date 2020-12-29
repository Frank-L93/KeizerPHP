<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Round;

class PresencesCreate extends Component
{
    public $rounds;
    public $show;

    public function mount()
    {
        $this->rounds = Round::all();
        $this->show = "hidden";
    }
    public function render()
    {
        return view('livewire.presences-create')->extends('layouts.app');
    }

    public function confirm()
    {
      $this->show="";
    }
}
