<?php

namespace App\Listeners\Module;

use App\Events\Module\ModuleUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleUpdatedEvent  $event
     * @return void
     */
    public function handle(ModuleUpdatedEvent $event)
    {
        $module = $event->module;
        $eventOptions = $event->options;
        $oldModule = $eventOptions['oldModel'];
    }
}
