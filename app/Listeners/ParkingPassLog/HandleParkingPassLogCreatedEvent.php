<?php

namespace App\Listeners\ParkingPassLog;

use App\Events\ParkingPassLog\ParkingPassLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleParkingPassLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ParkingPassLogCreatedEvent  $event
     * @return void
     */
    public function handle(ParkingPassLogCreatedEvent $event)
    {
        $parkingPassLog = $event->parkingPassLog;
        $eventOptions = $event->options;
    }
}
