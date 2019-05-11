<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SeanceStart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $pensionnaire;
    public $resident;

    /**
     * Create a new event instance.
     *
     * @param $pensionnaire
     * @param $resident
     */
    public function __construct($pensionnaire, $resident)
    {
        //
        $this->pensionnaire = $pensionnaire;
        $this->resident = $resident;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
