<?php

namespace App\Events\PostMarketPlace;

use App\DbModels\PostMarketplace;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class PostMarketPlaceUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var PostMarketplace
     */
    public $postMarketplace;

    /**
     * Create a new event instance.
     *
     * @param PostMarketplace $postMarketplace
     * @param array $options
     */
    public function __construct(PostMarketplace $postMarketplace, array $options = [])
    {
        $this->postMarketplace = $postMarketplace;
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
