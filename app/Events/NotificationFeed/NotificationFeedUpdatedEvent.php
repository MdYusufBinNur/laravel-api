<?php

namespace App\Events\NotificationFeed;

use App\DbModels\NotificationFeed;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class NotificationFeedUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var NotificationFeed
     */
    public $notificationFeed;

    /**
     * Create a new event instance.
     *
     * @param NotificationFeed $notificationFeed
     * @param array $options
     */
    public function __construct(NotificationFeed $notificationFeed, array $options = [])
    {
        $this->notificationFeed = $notificationFeed;
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
