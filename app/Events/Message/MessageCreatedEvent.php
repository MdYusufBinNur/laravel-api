<?php

namespace App\Events\Message;

use App\DbModels\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class MessageCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param array $options
     * @return void
     */
    public function __construct(Message $message, array $options = [])
    {
        $this->message = $message;
        $this->options = $options;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.User.1');
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastAs()
    {
        return ['messageCreated'];
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return ['message' => $this->message, 'text' => $this->options["request"]["text"]];
    }

}
