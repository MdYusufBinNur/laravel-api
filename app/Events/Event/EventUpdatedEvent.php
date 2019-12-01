<?php

namespace App\Events\Event;

use App\DbModels\Event;
use Illuminate\Queue\SerializesModels;

class EventUpdatedEvent
{
    use SerializesModels;

    /**
     * @var Event
     */
    public $event;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Event $event
     * @param array $options
     */
    public function __construct(Event $event, array $options = [])
    {
        $this->event = $event;
        $this->options = $options;
    }
}
