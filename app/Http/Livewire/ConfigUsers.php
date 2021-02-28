<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ConfigUsers extends Component
{
    use WithPagination;

    public $editedUserIndex = null;
    public $editedUserField = null;

    public function render()
    {
        return view('livewire.config-users', ['users' => User::paginate(10),]);
    }

    public function editUserRow($userIndex){
        $this->editedUserIndex = $userIndex;
    }

    public function editUserField($userIndex, $fieldname){
        $this->editedUserField = $userIndex . '.' . $fieldname;
    }
    public function saveUser($userIndex){}
}
