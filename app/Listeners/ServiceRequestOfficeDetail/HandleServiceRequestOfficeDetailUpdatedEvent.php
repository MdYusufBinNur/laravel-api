<?php

namespace App\Listeners\ServiceRequestOfficeDetail;

use App\Events\ServiceRequestOfficeDetail\ServiceRequestOfficeDetailUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestOfficeDetailUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestOfficeDetailUpdatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestOfficeDetailUpdatedEvent $event)
    {
        $serviceRequestOfficeDetail = $event->serviceRequestOfficeDetail;
        $eventOptions = $event->options;
        $oldServiceRequestOfficeDetail = $eventOptions['oldModel'];
    }
}
