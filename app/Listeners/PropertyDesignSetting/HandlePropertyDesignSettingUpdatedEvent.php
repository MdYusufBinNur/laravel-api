<?php

namespace App\Listeners\PropertyDesignSetting;

use App\Events\PropertyDesignSetting\PropertyDesignSettingUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePropertyDesignSettingUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PropertyDesignSettingUpdatedEvent  $event
     * @return void
     */
    public function handle(PropertyDesignSettingUpdatedEvent $event)
    {
        $propertyDesignSetting = $event->propertyDesignSetting;
        $eventOptions = $event->options;
        $oldPropertyDesignSetting = $eventOptions['oldModel'];
    }
}
