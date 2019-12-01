<?php

namespace App\Listeners\ServiceRequestLog;

use App\Events\ServiceRequestLog\ServiceRequestLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestLogCreatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestLogCreatedEvent $event)
    {
        $serviceRequestLog = $event->serviceRequestLog;
        $eventOptions = $event->options;
    }
}
