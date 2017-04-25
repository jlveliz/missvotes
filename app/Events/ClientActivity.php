<?php

namespace MissVote\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ClientActivity
{
    use InteractsWithSockets, SerializesModels;

    public $userId;

    public $activity;

    public $params;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId,$activity, array $params = null)
    {
        $this->userId = $userId;
        $this->activity = $activity;
        $this->params = $params;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
