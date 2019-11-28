<?php

namespace App\Listeners\PostEvent;

use App\Events\PostEvent\PostEventUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostEventUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostEventUpdatedEvent  $event
     * @return void
     */
    public function handle(PostEventUpdatedEvent $event)
    {
        $postEvent = $event->postEvent;
        $eventOptions = $event->options;
        $oldPostEvent = $eventOptions['oldModel'];
    }
}
