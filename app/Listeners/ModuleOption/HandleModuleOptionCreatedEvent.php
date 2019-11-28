<?php

namespace App\Listeners\ModuleOption;

use App\Events\ModuleOption\ModuleOptionCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleOptionCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleOptionCreatedEvent  $event
     * @return void
     */
    public function handle(ModuleOptionCreatedEvent $event)
    {
        $moduleOption = $event->moduleOption;
        $eventOptions = $event->options;
    }
}
