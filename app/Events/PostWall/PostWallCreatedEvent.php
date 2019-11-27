<?php

namespace App\Events\PostWall;

use App\DbModels\PostRecommendationType;
use App\DbModels\PostWall;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class PostWallCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostWall
     */
    public $postWall;

    /**
     * Create a new event instance.
     *
     * @param PostWall $postWall
     * @param array $options
     */
    public function __construct(PostWall $postWall, array $options = [])
    {
        $this->postWall = $postWall;
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
