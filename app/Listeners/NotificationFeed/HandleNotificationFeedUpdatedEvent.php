<?php

namespace App\Listeners\NotificationFeed;

use App\Events\NotificationFeed\NotificationFeedUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationFeedUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationFeedUpdatedEvent  $event
     * @return void
     */
    public function handle(NotificationFeedUpdatedEvent $event)
    {
        $notificationFeed = $event->notificationFeed;
        $eventOptions = $event->options;
        $oldNotificationFeed = $eventOptions['oldModel'];
    }
}
