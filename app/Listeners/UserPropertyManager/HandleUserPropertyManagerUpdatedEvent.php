<?php

namespace App\Listeners\UserPropertyManager;

use App\Events\UserPropertyManager\UserPropertyManagerUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserPropertyManagerUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserPropertyManagerUpdatedEvent  $event
     * @return void
     */
    public function handle(UserPropertyManagerUpdatedEvent $event)
    {
        $userPropertyManager = $event->userPropertyManager;
        $eventOptions = $event->options;
        $oldUserPropertyManager = $eventOptions['oldModel'];
    }
}
