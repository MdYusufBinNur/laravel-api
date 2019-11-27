<?php

namespace App\Listeners\NotificationTemplate;

use App\Events\NotificationTemplate\NotificationTemplateCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleNotificationTemplateCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  NotificationTemplateCreatedEvent  $event
     * @return void
     */
    public function handle(NotificationTemplateCreatedEvent $event)
    {
        $notificationTemplate = $event->notificationTemplate;
        $eventOptions = $event->options;
    }
}
