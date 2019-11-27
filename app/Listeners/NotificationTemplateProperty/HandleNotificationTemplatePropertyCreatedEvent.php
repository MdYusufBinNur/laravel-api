<?php

namespace App\Listeners\NotificationTemplateProperty;

use App\Events\NotificationTemplateProperty\NotificationTemplatePropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationTemplatePropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationTemplatePropertyCreatedEvent  $event
     * @return void
     */
    public function handle(NotificationTemplatePropertyCreatedEvent $event)
    {
        $notificationTemplateProperty = $event->notificationTemplateProperty;
        $eventOptions = $event->options;
    }
}
