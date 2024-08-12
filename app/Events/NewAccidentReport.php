<?php

namespace App\Events;

use App\Models\Data;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewAccidentReport implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $accident;

    public function __construct(Data $accident)
    {
        $this->accident = $accident;
    }

    public function broadcastOn()
    {
        return new Channel('accidents');
    }

    public function broadcastAs()
    {
        return 'new-accident-report';
    }
}
