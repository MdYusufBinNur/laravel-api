<?php

namespace App\Listeners\ResidentEmergency;

use App\Events\ResidentEmergency\ResidentEmergencyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentEmergencyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentEmergencyCreatedEvent  $event
     * @return void
     */
    public function handle(ResidentEmergencyCreatedEvent $event)
    {
        $residentEmergency = $event->residentEmergency;
        $eventOptions = $event->options;
    }
}
