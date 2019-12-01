<?php

namespace App\Listeners\ServiceRequestOfficeDetail;

use App\Events\ServiceRequestOfficeDetail\ServiceRequestOfficeDetailCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestOfficeDetailCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestOfficeDetailCreatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestOfficeDetailCreatedEvent $event)
    {
        $serviceRequestOfficeDetail = $event->serviceRequestOfficeDetail;
        $eventOptions = $event->options;
    }
}
