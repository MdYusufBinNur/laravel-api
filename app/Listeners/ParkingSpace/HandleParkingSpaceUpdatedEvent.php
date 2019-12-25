<?php

namespace App\Listeners\ParkingSpace;

use App\Events\ParkingSpace\ParkingSpaceUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingSpaceUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ParkingSpaceUpdatedEvent  $event
     * @return void
     */
    public function handle(ParkingSpaceUpdatedEvent $event)
    {
        $parkingSpace = $event->parkingSpace;
        $eventOptions = $event->options;
        $oldParkingSpace = $eventOptions['oldModel'];
    }
}
