<?php

namespace App\Listeners\PropertyLinkCategory;

use App\Events\PropertyLinkCategory\PropertyLinkCategoryCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyLinkCategoryCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyLinkCategoryCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyLinkCategoryCreatedEvent $event)
    {
        $propertyLinkCategory = $event->propertyLinkCategory;
        $eventOptions = $event->options;
    }
}
