<?php

namespace MissVote\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMailToPreselecteds
{
    use InteractsWithSockets, SerializesModels;

    public $misses;
    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $misses, $request)
    {
        $this->misses = $misses;
        $this->request = $request;
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
