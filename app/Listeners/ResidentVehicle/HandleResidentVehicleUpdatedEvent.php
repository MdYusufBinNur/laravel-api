<?php

namespace App\Listeners\ResidentVehicle;

use App\Events\ResidentVehicle\ResidentVehicleUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentVehicleUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentVehicleUpdatedEvent  $event
     * @return void
     */
    public function handle(ResidentVehicleUpdatedEvent $event)
    {
        $residentVehicle = $event->residentVehicle;
        $eventOptions = $event->options;
        $oldResidentVehicle = $eventOptions['oldModel'];
    }
}
