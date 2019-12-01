<?php

namespace App\Listeners\NotificationTemplateProperty;

use App\Events\NotificationTemplateProperty\NotificationTemplatePropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationTemplatePropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationTemplatePropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(NotificationTemplatePropertyUpdatedEvent $event)
    {
        $notificationTemplateProperty = $event->notificationTemplateProperty;
        $eventOptions = $event->options;
        $oldNotificationTemplateProperty = $eventOptions['oldModel'];
    }
}
