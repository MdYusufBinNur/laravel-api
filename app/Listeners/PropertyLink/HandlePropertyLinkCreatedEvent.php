<?php

namespace App\Listeners\PropertyLink;

use App\Events\PropertyLink\PropertyLinkCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyLinkCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyLinkCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyLinkCreatedEvent $event)
    {
        $propertyLink = $event->propertyLink;
        $eventOptions = $event->options;
    }
}
