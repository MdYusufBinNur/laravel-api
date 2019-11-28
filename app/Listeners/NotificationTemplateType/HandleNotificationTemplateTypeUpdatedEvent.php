<?php

namespace App\Listeners\NotificationTemplateType;

use App\Events\NotificationTemplateType\NotificationTemplateTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationTemplateTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationTemplateTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(NotificationTemplateTypeUpdatedEvent $event)
    {
        $notificationTemplateType = $event->notificationTemplateType;
        $eventOptions = $event->options;
        $oldNotificationTemplateType = $eventOptions['oldModel'];
    }
}
