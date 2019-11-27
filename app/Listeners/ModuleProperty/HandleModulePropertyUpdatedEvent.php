<?php

namespace App\Listeners\ModuleProperty;

use App\Events\ModuleProperty\ModulePropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModulePropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModulePropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(ModulePropertyUpdatedEvent $event)
    {
        $moduleProperty = $event->moduleProperty;
        $eventOptions = $event->options;
        $oldModuleProperty = $eventOptions['oldModel'];
    }
}
