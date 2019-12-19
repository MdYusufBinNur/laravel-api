<?php

namespace App\Listeners\Feedback;

use App\Events\Feedback\FeedbackCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFeedbackCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FeedbackCreatedEvent  $event
     * @return void
     */
    public function handle(FeedbackCreatedEvent $event)
    {
        $feedback = $event->feedback;
        $eventOptions = $event->options;
    }
}
