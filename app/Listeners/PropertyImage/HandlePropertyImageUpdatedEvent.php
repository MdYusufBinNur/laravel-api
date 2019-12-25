<?php

namespace App\Listeners\PropertyImage;

use App\Events\PropertyImage\PropertyImageUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyImageUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyImageUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyImageUpdatedEvent $event)
    {
        $propertyImage = $event->propertyImage;
        $eventOptions = $event->options;
        $oldPropertyImage = $eventOptions['oldModel'];
    }
}
