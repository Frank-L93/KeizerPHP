<?php

namespace App\Events;

use App\Models\Ranking;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RankingUpdating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ranking;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Ranking $ranking)
    {
        $this->ranking = $ranking;
    }
}
