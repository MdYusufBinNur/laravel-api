<?php

namespace App\Events\Event;

use App\DbModels\Event;
use Illuminate\Queue\SerializesModels;

class EventCreatedEvent
{
    use SerializesModels;

    /**
     * @var Event
     */
    public $eventModel;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Event $eventModel
     * @param array $options
     */
    public function __construct(Event $eventModel, array $options = [])
    {
        $this->eventModel = $eventModel;
        $this->options = $options;
    }
}
