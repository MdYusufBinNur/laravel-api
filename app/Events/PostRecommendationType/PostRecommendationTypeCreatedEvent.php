<?php

namespace App\Events\PostRecommendationType;

use App\DbModels\PostRecommendationType;
use Illuminate\Queue\SerializesModels;

class PostRecommendationTypeCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostRecommendationType
     */
    public $postRecommendationType;

    /**
     * Create a new event instance.
     *
     * @param PostRecommendationType $postRecommendationType
     * @param array $options
     */
    public function __construct(PostRecommendationType $postRecommendationType, array $options = [])
    {
        $this->postRecommendationType = $postRecommendationType;
        $this->options = $options;
    }
}
