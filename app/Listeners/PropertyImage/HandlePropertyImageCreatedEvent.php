<?php

namespace App\Listeners\PropertyImage;

use App\Events\PropertyImage\PropertyImageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyImageCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyImageCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyImageCreatedEvent $event)
    {
        $propertyImage = $event->propertyImage;
        $eventOptions = $event->options;
    }
}
