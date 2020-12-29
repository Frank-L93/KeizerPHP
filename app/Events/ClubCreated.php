<?php

namespace App\Events;

use App\Models\Club;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class ClubCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Club
     */
    public $club;

    /**
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Club $club
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Club $club, Request $request)
    {
        $this->request = $request;
        $this->club = $club;
    }
}
