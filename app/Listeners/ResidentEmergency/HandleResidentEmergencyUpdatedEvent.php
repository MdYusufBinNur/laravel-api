<?php

namespace App\Listeners\ResidentEmergency;

use App\Events\ResidentEmergency\ResidentEmergencyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentEmergencyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentEmergencyUpdatedEvent  $event
     * @return void
     */
    public function handle(ResidentEmergencyUpdatedEvent $event)
    {
        $residentEmergency = $event->residentEmergency;
        $eventOptions = $event->options;
        $oldResidentEmergency = $eventOptions['oldModel'];
    }
}
