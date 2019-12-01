<?php

namespace App\Listeners\InventoryItemLog;

use App\Events\InventoryItemLog\InventoryItemLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleInventoryItemLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  InventoryItemLogCreatedEvent  $event
     * @return void
     */
    public function handle(InventoryItemLogCreatedEvent $event)
    {
        $inventoryItemLog = $event->inventoryItemLog;
        $eventOptions = $event->options;
    }
}
