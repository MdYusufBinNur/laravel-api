<?php

namespace App\Listeners\Equipment;

use App\Events\Equipment\EquipmentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEquipmentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EquipmentCreatedEvent  $event
     * @return void
     */
    public function handle(EquipmentCreatedEvent $event)
    {
        $equipment = $event->equipment;
        $eventOptions = $event->options;
    }
}
