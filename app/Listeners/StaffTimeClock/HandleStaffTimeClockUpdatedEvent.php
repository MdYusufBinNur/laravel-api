<?php

namespace App\Listeners\StaffTimeClock;

use App\Events\StaffTimeClock\StaffTimeClockUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleStaffTimeClockUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  StaffTimeClockUpdatedEvent  $event
     * @return void
     */
    public function handle(StaffTimeClockUpdatedEvent $event)
    {
        $staffTimeClock = $event->staffTimeClock;
        $eventOptions = $event->options;
        $oldStaffTimeClock = $eventOptions['oldModel'];
    }
}
