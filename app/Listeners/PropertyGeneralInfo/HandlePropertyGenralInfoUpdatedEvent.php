<?php

namespace App\Listeners\PropertyGeneralInfo;

use App\Events\PropertyGeneralInfo\PropertyGeneralInfoUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyGenralInfoUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyGeneralInfoUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyGeneralInfoUpdatedEvent $event)
    {
        $propertyGeneralInfo = $event->propertyGeneralInfo;
        $eventOptions = $event->options;
        $oldPropertyGeneralInfo = $eventOptions['oldModel'];
    }
}
