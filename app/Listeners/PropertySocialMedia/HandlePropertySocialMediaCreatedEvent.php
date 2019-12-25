<?php

namespace App\Listeners\PropertySocialMedia;

use App\Events\PropertySocialMedia\PropertySocialMediaCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertySocialMediaCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertySocialMediaCreatedEvent  $event
     * @return void
     */
    public function handle(PropertySocialMediaCreatedEvent $event)
    {
        $propertySocialMedia = $event->propertySocialMedia;
        $eventOptions = $event->options;
    }
}
