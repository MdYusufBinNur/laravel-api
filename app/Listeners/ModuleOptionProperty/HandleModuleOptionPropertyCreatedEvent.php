<?php

namespace App\Listeners\ModuleOptionProperty;

use App\Events\ModuleOptionProperty\ModuleOptionPropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleOptionPropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleOptionPropertyCreatedEvent  $event
     * @return void
     */
    public function handle(ModuleOptionPropertyCreatedEvent $event)
    {
        $moduleOptionProperty = $event->moduleOptionProperty;
        $eventOptions = $event->options;
    }
}
