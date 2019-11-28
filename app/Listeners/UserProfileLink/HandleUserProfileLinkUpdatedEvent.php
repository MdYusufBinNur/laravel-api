<?php

namespace App\Listeners\UserProfileLink;

use App\Events\UserProfileLink\UserProfileLinkUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileLinkUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileLinkUpdatedEvent  $event
     * @return void
     */
    public function handle(UserProfileLinkUpdatedEvent $event)
    {
        $userProfileLink = $event->userProfileLink;
        $eventOptions = $event->options;
        $oldUserProfileLink = $eventOptions['oldModel'];
    }
}
