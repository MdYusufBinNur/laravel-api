<?php

namespace App\Listeners\StaffTimeClock;

use App\Events\StaffTimeClock\StaffTimeClockCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleStaffTimeClockCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  StaffTimeClockCreatedEvent  $event
     * @return void
     */
    public function handle(StaffTimeClockCreatedEvent $event)
    {
        $staffTimeClock = $event->staffTimeClock;
        $eventOptions = $event->options;
    }
}
