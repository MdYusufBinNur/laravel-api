<?php

namespace App\Listeners\Staff;

use App\Events\Staff\StaffCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleStaffCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  StaffCreatedEvent  $event
     * @return void
     */
    public function handle(StaffCreatedEvent $event)
    {
        $manager = $event->manager;
        $eventOptions = $event->options;
    }
}
