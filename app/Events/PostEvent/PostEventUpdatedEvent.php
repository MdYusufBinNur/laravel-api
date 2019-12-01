<?php

namespace App\Events\PostEvent;

use App\DbModels\PostEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class PostEventUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostEvent
     */
    public $postEvent;

    /**
     * Create a new event instance.
     *
     * @param PostEvent $postEvent
     * @param array $options
     */
    public function __construct(PostEvent $postEvent, array $options = [])
    {
        $this->postEvent = $postEvent;
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
