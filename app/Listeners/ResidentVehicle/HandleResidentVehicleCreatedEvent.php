<?php

namespace App\Listeners\ResidentVehicle;

use App\Events\ResidentVehicle\ResidentVehicleCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleResidentVehicleCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ResidentVehicleCreatedEvent  $event
     * @return void
     */
    public function handle(ResidentVehicleCreatedEvent $event)
    {
        $residentVehicle = $event->residentVehicle;
        $eventOptions = $event->options;
    }
}
