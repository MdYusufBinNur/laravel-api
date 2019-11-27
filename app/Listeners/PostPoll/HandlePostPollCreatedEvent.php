<?php

namespace App\Listeners\PostPoll;

use App\Events\PostPoll\PostPollCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostPollCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostPollCreatedEvent  $event
     * @return void
     */
    public function handle(PostPollCreatedEvent $event)
    {
        $postPoll = $event->postPoll;
        $eventOptions = $event->options;
    }
}
