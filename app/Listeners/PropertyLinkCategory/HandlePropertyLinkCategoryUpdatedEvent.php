<?php

namespace App\Listeners\PropertyLinkCategory;

use App\Events\PropertyLinkCategory\PropertyLinkCategoryUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyLinkCategoryUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyLinkCategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyLinkCategoryUpdatedEvent $event)
    {
        $propertyLinkCategory = $event->propertyLinkCategory;
        $eventOptions = $event->options;
        $oldPropertyLinkCategory = $eventOptions['oldModel'];
    }
}
