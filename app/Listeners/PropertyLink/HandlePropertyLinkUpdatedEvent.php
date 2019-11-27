<?php

namespace App\Listeners\PropertyLink;

use App\Events\PropertyLink\PropertyLinkUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyLinkUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyLinkUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyLinkUpdatedEvent $event)
    {
        $propertyLink = $event->propertyLink;
        $eventOptions = $event->options;
        $oldPropertyLink = $eventOptions['oldModel'];
    }
}
