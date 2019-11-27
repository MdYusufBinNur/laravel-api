<?php

namespace App\Listeners\Property;

use App\Events\Property\PropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyCreatedEvent $event)
    {
        $property = $event->property;
        $eventOptions = $event->options;
    }
}
