<?php

namespace App\Listeners\ModuleOption;

use App\Events\ModuleOption\ModuleOptionUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleOptionUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleOptionUpdatedEvent  $event
     * @return void
     */
    public function handle(ModuleOptionUpdatedEvent $event)
    {
        $moduleOption = $event->moduleOption;
        $eventOptions = $event->options;
        $oldModuleOption = $eventOptions['oldModel'];
    }
}
