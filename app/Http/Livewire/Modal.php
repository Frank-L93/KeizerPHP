<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $title;
    public $content;

    public function mount($type)
    {
        if($type == 'notifications')
        {
            $this->title = trans('modal.notificationsTitle');
            $this->content = trans('modal.notificationsContent');
        }
    }
    public function render()
    {
        return view('livewire.modal',
    [
        'title' => $this->title,
        'content' => $this->content,
    ]);
    }
}
