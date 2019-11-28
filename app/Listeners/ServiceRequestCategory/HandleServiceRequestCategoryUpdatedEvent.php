<?php

namespace App\Listeners\ServiceRequestCategory;

use App\Events\ServiceRequestCategory\ServiceRequestCategoryUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleServiceRequestCategoryUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ServiceRequestCategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(ServiceRequestCategoryUpdatedEvent $event)
    {
        $serviceRequestCategory = $event->serviceRequestCategory;
        $eventOptions = $event->options;
        $oldServiceRequestCategory = $eventOptions['oldModel'];
    }
}
