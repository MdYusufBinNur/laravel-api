<?php

namespace App\Listeners\InventoryItem;

use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\InventoryItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleInventoryItemUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param InventoryItemUpdatedEvent $event
     * @return void
     */
    public function handle(InventoryItemUpdatedEvent $event)
    {
        $inventoryItem = $event->inventoryItem;
        $eventOptions = $event->options;
        $oldInventoryItem = $eventOptions['oldModel'];

        $hasQuantityChanged = $this->hasAFieldValueChanged($inventoryItem, $oldInventoryItem, 'quantity');

        if ($hasQuantityChanged) {

            // log the inventory item change
            $inventoryItemLogRepository = app(InventoryItemLogRepository::class);
            $inventoryItemLogRepository->save([
                'inventoryItemId' => $inventoryItem->id,
                'propertyId' => $inventoryItem->propertyId,
                'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
                'QuantityChange' => $inventoryItem->quantity - $oldInventoryItem->quantity,
            ]);
        }


    }
}
