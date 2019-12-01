<?php

namespace App\Events\EventSignup;

use App\DbModels\EventSignup;
use Illuminate\Queue\SerializesModels;

class EventSignupCreatedEvent
{
    use SerializesModels;

    /**
     * @var EventSignup
     */
    public $eventSignup;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param EventSignup $eventSignup
     * @param array $options
     */
    public function __construct(EventSignup $eventSignup, array $options = [])
    {
        $this->eventSignup = $eventSignup;
        $this->options = $options;
    }
}
