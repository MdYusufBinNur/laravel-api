<?php

namespace App\Events\InventoryItemLog;

use App\DbModels\InventoryItemLog;
use Illuminate\Queue\SerializesModels;

class InventoryItemLogCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var InventoryItemLog
     */
    public $inventoryItemLog;

    /**
     * Create a new event instance.
     *
     * @param InventoryItemLog $inventoryItemLog
     * @param array $options
     */
    public function __construct(InventoryItemLog $inventoryItemLog, array $options = [])
    {
        $this->inventoryItemLog = $inventoryItemLog;
        $this->options = $options;
    }
}
