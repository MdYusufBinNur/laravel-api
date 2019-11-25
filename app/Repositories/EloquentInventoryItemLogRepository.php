<?php


namespace App\Repositories;


use App\Repositories\Contracts\InventoryItemLogRepository;

class EloquentInventoryItemLogRepository extends EloquentBaseRepository implements InventoryItemLogRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['iil.inventoryItem' => 'inventoryItem'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
