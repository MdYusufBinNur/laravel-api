<?php

namespace App\Events\LdsSlideProperty;

use App\DbModels\LdsSlideProperty;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class LdsSlidePropertyCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var LdsSlideProperty
     */
    public $ldsSlideProperty;

    /**
     * Create a new event instance.
     *
     * @param LdsSlideProperty $ldsSlideProperty
     * @param array $options
     */
    public function __construct(LdsSlideProperty $ldsSlideProperty, array $options = [])
    {
        $this->ldsSlideProperty = $ldsSlideProperty;
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
