<?php

namespace App\Events\InventoryItem;

use App\DbModels\InventoryItem;
use Illuminate\Queue\SerializesModels;

class InventoryItemUpdatedEvent
{
    use SerializesModels;

    /**
     * @var InventoryItem
     */
    public $inventoryItem;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param InventoryItem $inventoryItem
     * @param array $options
     * @return void
     */
    public function __construct(InventoryItem $inventoryItem, array $options = [])
    {
        $this->inventoryItem = $inventoryItem;
        $this->options = $options;
    }
}
