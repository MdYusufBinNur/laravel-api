<?php

namespace App\Events\Message;

use App\DbModels\Message;
use Illuminate\Queue\SerializesModels;

class MessageCreatedEvent
{
    use SerializesModels;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Message $message
     * @param array $options
     * @return void
     */
    public function __construct(Message $message, array $options = [])
    {
        $this->message = $message;
        $this->options = $options;
    }
}
