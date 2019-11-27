<?php

namespace App\Listeners\ParkingPassLog;

use App\Events\ParkingPassLog\ParkingPassLogUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingPassLogUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ParkingPassLogUpdatedEvent  $event
     * @return void
     */
    public function handle(ParkingPassLogUpdatedEvent $event)
    {
        $parkingPassLog = $event->parkingPassLog;
        $eventOptions = $event->options;
        $oldParkingPassLog = $eventOptions['oldModel'];
    }
}
