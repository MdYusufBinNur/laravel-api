<?php

namespace App\Listeners\InventoryItem;

use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\InventoryItemLogRepository;
use Carbon\Carbon;
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

        $inventoryItemLogData = [
            'inventoryItemId' => $inventoryItem->id,
            'propertyId' => $inventoryItem->propertyId,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'QuantityChange' => $inventoryItem->quantity,
            'vendorId' => $eventOptions['request']['vendorId'] ?? NULL
        ];

        if (!empty($eventOptions['request']['cost'])) {
            $expenseRepository = app(ExpenseRepository::class);
            $expense = $expenseRepository->save(['categoryId' => 1, 'amount' => $eventOptions['request']['cost'], 'expenseDate' => Carbon::today(), 'propertyId' => $inventoryItem->propertyId, 'expenseReason' => 'Expense from Inventory# ' . $inventoryItem->id]);
            $inventoryItemLogData['expenseId'] = $expense->id;
            $inventoryItemLogData['cost'] = $eventOptions['request']['cost'];
        }

        $inventoryItemLogRepository->save($inventoryItemLogData);
    }
}
