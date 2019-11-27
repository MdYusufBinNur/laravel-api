<?php

namespace App\Listeners\NotificationTemplate;

use App\Events\NotificationTemplate\NotificationTemplateUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationTemplateUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationTemplateUpdatedEvent  $event
     * @return void
     */
    public function handle(NotificationTemplateUpdatedEvent $event)
    {
        $notificationTemplate = $event->notificationTemplate;
        $eventOptions = $event->options;
        $oldNotificationTemplate= $eventOptions['oldModel'];
    }
}
