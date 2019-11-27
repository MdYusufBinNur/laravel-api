<?php

namespace App\Listeners\Module;

use App\Events\Module\ModuleCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleModuleCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ModuleCreatedEvent  $event
     * @return void
     */
    public function handle(ModuleCreatedEvent $event)
    {
        $module = $event->module;
        $eventOptions = $event->options;
    }
}
