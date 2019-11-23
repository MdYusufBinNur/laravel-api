<?php


namespace App\Repositories;


use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Repositories\Contracts\InventoryItemRepository;

class EloquentInventoryItemRepository extends EloquentBaseRepository implements InventoryItemRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $inventoryItem = parent::save($data);

        event(new InventoryItemCreatedEvent($inventoryItem, $this->generateEventOptionsForModel()));

        return $inventoryItem;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $inventoryItem = parent::update($model, $data);

        event(new InventoryItemUpdatedEvent($inventoryItem, $this->generateEventOptionsForModel()));

        return $inventoryItem;
    }

}
