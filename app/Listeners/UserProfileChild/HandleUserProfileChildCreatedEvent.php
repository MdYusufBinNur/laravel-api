<?php

namespace App\Listeners\UserProfileChild;

use App\Events\UserProfileChild\UserProfileChildCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileChildCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileChildCreatedEvent  $event
     * @return void
     */
    public function handle(UserProfileChildCreatedEvent $event)
    {
        $userProfileChild = $event->userProfileChild;
        $eventOptions = $event->options;
    }
}
