<?php

namespace App\Listeners\UserPropertyResident;

use App\Events\UserPropertyResident\UserPropertyResidentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserPropertyResidentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserPropertyResidentUpdatedEvent  $event
     * @return void
     */
    public function handle(UserPropertyResidentUpdatedEvent $event)
    {
        $userPropertyResident = $event->userPropertyResident;
        $eventOptions = $event->options;
        $oldUserPropertyResident = $eventOptions['oldModel'];
    }
}
