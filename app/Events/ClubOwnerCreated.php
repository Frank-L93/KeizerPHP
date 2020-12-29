<?php

namespace App\Events;

use App\Models\Club;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClubOwnerCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $club;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Club $club
     */
    public function __construct(User $user, Club $club)
    {
        $this->user = $user;
        $this->club = $club;
    }


}
