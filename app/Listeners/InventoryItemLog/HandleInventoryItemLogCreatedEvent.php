<?php

namespace App\Listeners\InventoryItemLog;

use App\DbModels\Role;
use App\Events\InventoryItemLog\InventoryItemLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Inventory\SendInventoryUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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

        $uptoStandardStaffUserEmails = $inventoryItemLog->property->staffUsers()->where('user_roles.roleId', '>=', Role::ROLE_ADMIN_STANDARD)->get();

        foreach ($uptoStandardStaffUserEmails as $email) {
            Mail::to($email)->send(new SendInventoryUpdate($inventoryItemLog));
        }

    }
}
