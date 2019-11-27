<?php

namespace App\Listeners\PropertyGeneralInfo;

use App\Events\PropertyGeneralInfo\PropertyGeneralInfoCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyGenralInfoCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyGeneralInfoCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyGeneralInfoCreatedEvent $event)
    {
        $propertyGeneralInfo = $event->propertyGeneralInfo;
        $eventOptions = $event->options;
    }
}
