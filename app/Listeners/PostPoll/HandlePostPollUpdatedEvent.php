<?php

namespace App\Listeners\PostPoll;

use App\Events\PostPoll\PostPollUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostPollUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostPollUpdatedEvent  $event
     * @return void
     */
    public function handle(PostPollUpdatedEvent $event)
    {
        $postPoll = $event->postPoll;
        $eventOptions = $event->options;
        $oldPostPoll = $eventOptions['oldModel'];
    }
}
