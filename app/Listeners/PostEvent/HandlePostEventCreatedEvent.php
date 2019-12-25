<?php

namespace App\Listeners\PostEvent;

use App\Events\PostEvent\PostEventCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostEventCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostEventCreatedEvent  $event
     * @return void
     */
    public function handle(PostEventCreatedEvent $event)
    {
        $postEvent = $event->postEvent;
        $eventOptions = $event->options;
    }
}
