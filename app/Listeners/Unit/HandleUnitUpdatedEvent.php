<?php

namespace App\Listeners\Unit;

use App\Events\Unit\UnitUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUnitUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UnitUpdatedEvent  $event
     * @return void
     */
    public function handle(UnitUpdatedEvent $event)
    {
        $unit = $event->unit;
        $eventOptions = $event->options;
        $oldUnit = $eventOptions['oldModel'];
    }
}
