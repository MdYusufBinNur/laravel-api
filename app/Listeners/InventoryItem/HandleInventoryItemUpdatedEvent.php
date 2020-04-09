<?php

namespace App\Listeners\InventoryItem;

use App\DbModels\Property;
use App\DbModels\Role;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Inventory\NotifyInventoryReachedThreshold;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\InventoryItemLogRepository;
use App\Repositories\Contracts\PropertyRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
            $inventoryItemLogData = [
                'inventoryItemId' => $inventoryItem->id,
                'propertyId' => $inventoryItem->propertyId,
                'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
                'quantityChange' => $inventoryItem->quantity - $oldInventoryItem->quantity,
                'description' => 'Quantity changed.',
                'vendorId' => $eventOptions['request']['vendorId'] ?? NULL
            ];

            if (isset($eventOptions['request']['toPropertyId'])) {
                $propertyRepository = app(PropertyRepository::class);
                $property = $propertyRepository->findOne($eventOptions['request']['toPropertyId']);
                if ($property instanceof Property) {
                    $inventoryItemLogData['description'] = 'Transferred to the property ' . $property->title;
                }
            }

            if (!empty($eventOptions['request']['cost'])) {
                $expenseRepository = app(ExpenseRepository::class);
                $expense = $expenseRepository->save(['categoryId' => 1, 'amount' => $eventOptions['request']['cost'], 'expenseDate' => Carbon::today(), 'propertyId' => $inventoryItem->propertyId, 'expenseReason' => 'Expense from Inventory# ' . $inventoryItem->id]);
                $inventoryItemLogData['expenseId'] = $expense->id;
                $inventoryItemLogData['cost'] = $eventOptions['request']['cost'];
            }

            $inventoryItemLogRepository->save($inventoryItemLogData);

            // send email if `quantity` is less than `notifyCount`
            if ($inventoryItem->quantity < $inventoryItem->notifyCount) {
                $uptoStandardStaffUserEmails = $inventoryItem->property->staffUsers()->where('user_roles.roleId', '>=', Role::ROLE_ADMIN_STANDARD)->get();

                foreach ($uptoStandardStaffUserEmails as $staffEmail) {
                    Mail::to($staffEmail)->send(new NotifyInventoryReachedThreshold($inventoryItem));
                }
            }
        }



    }
}
