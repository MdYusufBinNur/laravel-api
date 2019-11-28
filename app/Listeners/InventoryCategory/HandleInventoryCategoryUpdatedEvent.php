<?php

namespace App\Listeners\InventoryCategory;

use App\Events\InventoryCategory\InventoryCategoryCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleInventoryCategoryUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  InventoryCategoryCreatedEvent  $event
     * @return void
     */
    public function handle(InventoryCategoryCreatedEvent $event)
    {
        $inventoryCategory = $event->inventoryCategory;
        $eventOptions = $event->options;
        $oldInventoryCategory = $eventOptions['oldModel'];
    }
}
