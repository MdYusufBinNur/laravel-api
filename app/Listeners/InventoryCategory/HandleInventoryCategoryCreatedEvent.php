<?php

namespace App\Listeners\InventoryCategory;

use App\Events\InventoryCategory\InventoryCategoryUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleInventoryCategoryCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  InventoryCategoryUpdatedEvent  $event
     * @return void
     */
    public function handle(InventoryCategoryUpdatedEvent $event)
    {
        $inventoryCategory = $event->inventoryCategory;
        $eventOptions = $event->options;
    }
}
