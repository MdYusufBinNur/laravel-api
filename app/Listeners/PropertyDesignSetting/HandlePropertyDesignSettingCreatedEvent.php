<?php

namespace App\Listeners\PropertyDesignSetting;

use App\Events\PropertyDesignSetting\PropertyDesignSettingCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyDesignSettingCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyDesignSettingCreatedEvent  $event
     * @return void
     */
    public function handle(PropertyDesignSettingCreatedEvent $event)
    {
        $propertyDesignSetting = $event->propertyDesignSetting;
        $eventOptions = $event->options;
    }
}
