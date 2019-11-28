<?php

namespace App\Listeners\UserProfilePost;

use App\Events\UserProfilePost\UserProfilePostCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUserProfilePostCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UserProfilePostCreatedEvent  $event
     * @return void
     */
    public function handle(UserProfilePostCreatedEvent $event)
    {
        $userProfilePost = $event->userProfilePost;
        $eventOptions = $event->options;
    }
}
