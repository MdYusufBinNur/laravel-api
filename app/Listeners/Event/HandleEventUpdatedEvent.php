<?php

namespace App\Listeners\Event;

use App\Events\Event\EventCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EventCreatedEvent  $event
     * @return void
     */
    public function handle(EventCreatedEvent $event)
    {
        $event = $event->event;
        $eventOptions = $event->options;
        $oldEvent = $eventOptions['oldModel'];
    }
}
