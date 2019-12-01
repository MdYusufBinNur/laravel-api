<?php

namespace App\Listeners\ServiceRequestLog;

use App\Events\ServiceRequestLog\ServiceRequestLogUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestLogUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestLogUpdatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestLogUpdatedEvent $event)
    {
        $serviceRequestLog = $event->serviceRequestLog;
        $eventOptions = $event->options;
        $oldServiceRequestLog = $eventOptions['oldModel'];
    }
}
