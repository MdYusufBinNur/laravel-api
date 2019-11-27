<?php

namespace App\Events\PostRecommendation;

use App\DbModels\PostRecommendation;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class PostRecommendationUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostRecommendation
     */
    public $postRecommendation;

    /**
     * Create a new event instance.
     *
     * @param PostRecommendation $postRecommendation
     * @param array $options
     */
    public function __construct(PostRecommendation $postRecommendation, array $options = [])
    {
        $this->postRecommendation = $postRecommendation;
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
