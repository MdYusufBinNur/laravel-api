<?php

namespace App\Listeners\Unit;

use App\Events\Unit\UnitCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleUnitCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  UnitCreatedEvent  $event
     * @return void
     */
    public function handle(UnitCreatedEvent $event)
    {
        $unit = $event->unit;
        $eventOptions = $event->options;
    }
}
