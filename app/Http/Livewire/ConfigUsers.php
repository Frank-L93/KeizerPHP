<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfigUsers extends Component
{
    public $users;

    public function render()
    {
        return view('livewire.config-users');
    }
}
