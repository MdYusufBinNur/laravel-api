<?php

namespace App\Listeners\Event;

use App\Events\Event\EventUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEventCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EventUpdatedEvent  $event
     * @return void
     */
    public function handle(EventUpdatedEvent $event)
    {
        $event = $event->event;
        $eventOptions = $event->options;
    }
}
