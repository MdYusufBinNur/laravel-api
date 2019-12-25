<?php

namespace App\Listeners\ModuleOptionProperty;

use App\Events\ModuleOptionProperty\ModuleOptionPropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleOptionPropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleOptionPropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(ModuleOptionPropertyUpdatedEvent $event)
    {
        $moduleOptionProperty = $event->moduleOptionProperty;
        $eventOptions = $event->options;
        $oldModuleOptionProperty = $eventOptions['oldModel'];
    }
}
