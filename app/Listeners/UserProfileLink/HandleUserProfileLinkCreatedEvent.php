<?php

namespace App\Listeners\UserProfileLink;

use App\Events\UserProfileLink\UserProfileLinkCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfileLinkCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfileLinkCreatedEvent  $event
     * @return void
     */
    public function handle(UserProfileLinkCreatedEvent $event)
    {
        $userProfileLink = $event->userProfileLink;
        $eventOptions = $event->options;
    }
}
