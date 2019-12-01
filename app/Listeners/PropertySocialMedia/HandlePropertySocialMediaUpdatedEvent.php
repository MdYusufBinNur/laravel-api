<?php

namespace App\Listeners\PropertySocialMedia;

use App\Events\PropertySocialMedia\PropertySocialMediaUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertySocialMediaUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertySocialMediaUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertySocialMediaUpdatedEvent $event)
    {
        $propertySocialMedia = $event->propertySocialMedia;
        $eventOptions = $event->options;
        $oldPropertySocialMedia = $eventOptions['oldModel'];
    }
}
