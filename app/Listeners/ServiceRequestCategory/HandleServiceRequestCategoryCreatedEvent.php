<?php

namespace App\Listeners\ServiceRequestCategory;

use App\Events\ServiceRequestCategory\ServiceRequestCategoryCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestCategoryCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestCategoryCreatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestCategoryCreatedEvent $event)
    {
        $serviceRequestCategory = $event->serviceRequestCategory;
        $eventOptions = $event->options;
    }
}
