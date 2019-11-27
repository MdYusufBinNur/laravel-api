<?php

namespace App\Listeners\FdiLog;

use App\Events\FdiLog\FdiLogUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleFdiLogUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  FdiLogUpdatedEvent  $event
     * @return void
     */
    public function handle(FdiLogUpdatedEvent $event)
    {
        $fdiLog = $event->fdiLog;
        $eventOptions = $event->options;
        $oldFdiLog = $eventOptions['oldModel'];
    }
}
