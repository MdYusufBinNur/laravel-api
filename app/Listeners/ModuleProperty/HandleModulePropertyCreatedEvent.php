<?php

namespace App\Listeners\ModuleProperty;

use App\Events\ModuleProperty\ModulePropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModulePropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModulePropertyCreatedEvent  $event
     * @return void
     */
    public function handle(ModulePropertyCreatedEvent $event)
    {
        $moduleProperty = $event->moduleProperty;
        $eventOptions = $event->options;
    }
}
