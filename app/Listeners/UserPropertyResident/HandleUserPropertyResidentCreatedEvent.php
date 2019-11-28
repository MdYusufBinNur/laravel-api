<?php

namespace App\Listeners\UserPropertyResident;

use App\Events\UserPropertyResident\UserPropertyResidentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserPropertyResidentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserPropertyResidentCreatedEvent  $event
     * @return void
     */
    public function handle(UserPropertyResidentCreatedEvent $event)
    {
        $userPropertyResident = $event->userPropertyResident;
        $eventOptions = $event->options;
    }
}
