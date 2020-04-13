<?php

namespace App\Listeners\EquipmentMaintenanceLog;

use App\Events\EquipmentMaintenanceLog\EquipmentMaintenanceLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEquipmentMaintenanceLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EquipmentMaintenanceLogCreatedEvent  $event
     * @return void
     */
    public function handle(EquipmentMaintenanceLogCreatedEvent $event)
    {
        $equipmentMaintenanceLog = $event->equipmentMaintenanceLog;
        $eventOptions = $event->options;
    }
}
