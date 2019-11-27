<?php

namespace App\Listeners\Equipment;

use App\Events\Equipment\EquipmentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEquipmentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EquipmentUpdatedEvent  $event
     * @return void
     */
    public function handle(EquipmentUpdatedEvent $event)
    {
        $equipment = $event->equipment;
        $eventOptions = $event->options;
        $oldEquipment = $eventOptions['oldModel'];
    }
}
