<?php

namespace App\Mail\Inventory;

use App\DbModels\InventoryItemLog;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInventoryUpdate extends Mailable
{
    use SerializesModels;

    /**
     * @var InventoryItemLog
     */
    public $inventoryItemLog;

    /**
     * Create a new message instance.
     *
     * @param InventoryItemLog $inventoryItemLog
     * @return void
     */
    public function __construct(InventoryItemLog $inventoryItemLog)
    {
        $this->inventoryItemLog = $inventoryItemLog;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $property = $this->inventoryItemLog->property;
        $inventoryItem = $this->inventoryItemLog->inventoryItem;

        return $this->subject('Inventory item updated')->view('inventory.item-update.index')
            ->with(['inventoryItemLog' => $this->inventoryItemLog, 'inventoryItem' => $inventoryItem, 'property' => $property]);
    }
}
