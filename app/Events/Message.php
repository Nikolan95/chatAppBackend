<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userid;
    public $conversationid;
    public $message;
    public $read;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userid, $conversationid, $message, $read)
    {
        $this->userid = $userid;
        $this->conversationid = $conversationid;
        $this->message = $message;
        $this->read = false;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }
    public function broadcastAs()
    {
        return 'message';
    }
}
