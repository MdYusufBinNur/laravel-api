<?php

namespace App\Listeners\ParkingSpace;

use App\Events\ParkingSpace\ParkingSpaceCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingSpaceCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ParkingSpaceCreatedEvent  $event
     * @return void
     */
    public function handle(ParkingSpaceCreatedEvent $event)
    {
        $parkingSpace = $event->parkingSpace;
        $eventOptions = $event->options;
    }
}
