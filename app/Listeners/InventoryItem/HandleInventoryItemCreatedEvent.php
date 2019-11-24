<?php

namespace App\Listeners\InventoryItem;

use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\InventoryItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleInventoryItemCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param InventoryItemCreatedEvent $event
     * @return void
     */
    public function handle(InventoryItemCreatedEvent $event)
    {
        $inventoryItem = $event->inventoryItem;
        $eventOptions = $event->options;


        // log the inventory item
        $inventoryItemLogRepository = app(InventoryItemLogRepository::class);

        $inventoryItemLogRepository->save([
            'inventoryItemId' => $inventoryItem->id,
            'propertyId' => $inventoryItem->propertyId,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'QuantityChange' => $inventoryItem->quantity,
        ]);

    }
}
