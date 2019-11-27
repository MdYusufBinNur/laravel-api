<?php

namespace App\Events\InventoryCategory;

use App\DbModels\InventoryCategory;
use Illuminate\Queue\SerializesModels;

class InventoryCategoryCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var InventoryCategory
     */
    public $inventoryCategory;

    /**
     * Create a new event instance.
     *
     * @param InventoryCategory $inventoryCategory
     * @param array $options
     */
    public function __construct(InventoryCategory $inventoryCategory, array $options = [])
    {
        $this->inventoryCategory = $inventoryCategory;
        $this->options = $options;
    }
}
