<?php

namespace App\Listeners\Property;

use App\Events\Property\PropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyUpdatedEvent $event)
    {
        $property = $event->property;
        $eventOptions = $event->options;
        $oldProperty = $eventOptions['oldModel'];
    }
}
