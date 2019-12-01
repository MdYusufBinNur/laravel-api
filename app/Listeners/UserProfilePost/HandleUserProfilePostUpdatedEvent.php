<?php

namespace App\Listeners\UserProfilePost;

use App\Events\UserProfilePost\UserProfilePostUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfilePostUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfilePostUpdatedEvent  $event
     * @return void
     */
    public function handle(UserProfilePostUpdatedEvent $event)
    {
        $userProfilePost = $event->userProfilePost;
        $eventOptions = $event->options;
        $oldUserProfilePost = $eventOptions['oldModel'];
    }
}
