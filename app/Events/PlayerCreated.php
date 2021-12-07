<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayerCreated
{
use Dispatchable, InteractsWithSockets, SerializesModels;

public $user;

public $password;

/**
* Create a new event instance.
* This Event is used when a Player is created by the Club-owner
* @param \App\Models\User $user
*/
public function __construct(User $user, $password)
{
$this->user = $user;
$this->password = $password;
}

}
