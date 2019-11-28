<?php

namespace App\Listeners\UserProfileChild;

use App\Events\UserProfileChild\UserProfileChildUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileChildUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileChildUpdatedEvent  $event
     * @return void
     */
    public function handle(UserProfileChildUpdatedEvent $event)
    {
        $userProfileChild = $event->userProfileChild;
        $eventOptions = $event->options;
        $oldUserProfileChild = $eventOptions['oldModel'];
    }
}
