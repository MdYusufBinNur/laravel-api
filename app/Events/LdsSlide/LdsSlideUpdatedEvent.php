<?php

namespace App\Events\LdsSlide;

use App\DbModels\LdsSlide;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;

class LdsSlideUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var LdsSlide
     */
    public $ldsSlide;

    /**
     * Create a new event instance.
     *
     * @param LdsSlide $ldsSlide
     * @param array $options
     */
    public function __construct(LdsSlide $ldsSlide, array $options = [])
    {
        $this->ldsSlide = $ldsSlide;
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
