<?php

namespace App\Events\PostPoll;

use App\DbModels\PostPoll;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class PostPollCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostPoll
     */
    public $postPoll;

    /**
     * Create a new event instance.
     *
     * @param PostPoll $postPoll
     * @param array $options
     */
    public function __construct(PostPoll $postPoll, array $options = [])
    {
        $this->postPoll = $postPoll;
        $this->options = $options;
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
