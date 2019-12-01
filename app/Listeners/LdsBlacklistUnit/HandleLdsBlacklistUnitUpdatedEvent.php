<?php

namespace App\Listeners\LdsBlacklistUnit;

use App\Events\LdsBlacklistUnit\LdsBlacklistUnitCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsBlacklistUnitUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsBlacklistUnitCreatedEvent  $event
     * @return void
     */
    public function handle(LdsBlacklistUnitCreatedEvent $event)
    {
        $ldsBlacklistUnit = $event->ldsBlacklistUnit;
        $eventOptions = $event->options;
        $oldLdsBlacklistUnit = $eventOptions['oldModel'];
    }
}
