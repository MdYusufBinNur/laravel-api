<?php

namespace App\Listeners\Staff;

use App\Events\Staff\StaffUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleStaffUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  StaffUpdatedEvent  $event
     * @return void
     */
    public function handle(StaffUpdatedEvent $event)
    {
        $manager = $event->manager;
        $eventOptions = $event->options;
        $oldManager = $eventOptions['oldModel'];
    }
}
