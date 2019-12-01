<?php

namespace App\Listeners\ModuleSettingProperty;

use App\Events\ModuleSettingProperty\ModuleSettingPropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleSettingPropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleSettingPropertyCreatedEvent  $event
     * @return void
     */
    public function handle(ModuleSettingPropertyCreatedEvent $event)
    {
        $moduleSettingProperty = $event->moduleSettingProperty;
        $eventOptions = $event->options;
    }
}
