<?php

namespace App\Listeners\NotificationFeed;

use App\Events\NotificationFeed\NotificationFeedCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationFeedCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationFeedCreatedEvent  $event
     * @return void
     */
    public function handle(NotificationFeedCreatedEvent $event)
    {
        $notificationFeed = $event->notificationFeed;
        $eventOptions = $event->options;
    }
}
