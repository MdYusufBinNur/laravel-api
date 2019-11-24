<?php

namespace App\Listeners\InventoryItem;

use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\InventoryItem\NotifyInventoryDecreased;
use App\Repositories\Contracts\InventoryItemLogRepository;
use App\Repositories\Contracts\UserRoleRepository;
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
            $inventoryItemLogRepository->save([
                'inventoryItemId' => $inventoryItem->id,
                'propertyId' => $inventoryItem->propertyId,
                'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
                'QuantityChange' => $inventoryItem->quantity - $oldInventoryItem->quantity,
            ]);

            // send email if `quantity` is less than `notifyCount`
            if ($inventoryItem->quantity < $inventoryItem->notifyCount) {
                $userRoleRepository = app(UserRoleRepository::class);
                $staffEmails = $userRoleRepository->getEmailsOfThePropertyStaffs($inventoryItem->propertyId);

                foreach ($staffEmails as $staffEmail) {
                    Mail::to($staffEmail)->send(new NotifyInventoryDecreased($inventoryItem));
                }
            }
        }



    }
}
