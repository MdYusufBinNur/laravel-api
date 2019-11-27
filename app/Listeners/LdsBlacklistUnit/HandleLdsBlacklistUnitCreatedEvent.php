<?php

namespace App\Listeners\LdsBlacklistUnit;

use App\Events\LdsBlacklistUnit\LdsBlacklistUnitUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsBlacklistUnitCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsBlacklistUnitUpdatedEvent  $event
     * @return void
     */
    public function handle(LdsBlacklistUnitUpdatedEvent $event)
    {
        $ldsBlacklistUnit = $event->ldsBlacklistUnit;
        $eventOptions = $event->options;
    }
}
