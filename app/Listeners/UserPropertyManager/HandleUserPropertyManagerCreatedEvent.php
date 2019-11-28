<?php

namespace App\Listeners\UserPropertyManager;

use App\Events\UserPropertyManager\UserPropertyManagerCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserPropertyManagerCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserPropertyManagerCreatedEvent  $event
     * @return void
     */
    public function handle(UserPropertyManagerCreatedEvent $event)
    {
        $userPropertyManager = $event->userPropertyManager;
        $eventOptions = $event->options;
    }
}
