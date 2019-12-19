<?php

namespace App\Events\Feedback;

use App\DbModels\Feedback;
use Illuminate\Queue\SerializesModels;

class FeedbackUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Feedback
     */
    public $feedback;

    /**
     * Create a new event instance.
     *
     * @param Feedback $feedback
     * @param array $options
     */
    public function __construct(Feedback $feedback, array $options = [])
    {
        $this->feedback = $feedback;
        $this->options = $options;
    }
}
