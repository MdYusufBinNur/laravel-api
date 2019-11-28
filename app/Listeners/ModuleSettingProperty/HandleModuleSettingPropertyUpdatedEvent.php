<?php

namespace App\Listeners\ModuleSettingProperty;

use App\Events\ModuleSettingProperty\ModuleSettingPropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleSettingPropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleSettingPropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(ModuleSettingPropertyUpdatedEvent $event)
    {
        $moduleSettingProperty = $event->moduleSettingProperty;
        $eventOptions = $event->options;
        $oldModuleSettingProperty = $eventOptions['oldModel'];
    }
}
