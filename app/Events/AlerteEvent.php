<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AlerteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $person;
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @param $person
     * @param $roomId
     */
    public function __construct($person, $roomId)
    {
        $this->person = $person;
        $this->roomId = $roomId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('alerts');
    }
}
