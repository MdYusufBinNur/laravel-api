<?php

namespace App\Mail\InventoryItem;

use App\DbModels\InventoryItem;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyInventoryDecreased extends Mailable
{
    use SerializesModels;

    /**
     * @var InventoryItem
     */
    public $inventoryItem;

    /**
     * Create a new message instance.
     *
     * @param InventoryItem $inventoryItem
     * @return void
     */
    public function __construct(InventoryItem $inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $property = $this->inventoryItem->property;

        return $this->subject("A Inventory Item Decreased")->view('inventory.notify-decreased.index')
            ->with(['inventory' => $this->inventoryItem, 'property' => $property]);
    }
}
