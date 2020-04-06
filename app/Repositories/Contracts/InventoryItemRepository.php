<?php


namespace App\Repositories\Contracts;


use App\DbModels\InventoryItem;

interface InventoryItemRepository extends BaseRepository
{
    /**
     * transfer an inventory item to another
     *
     * @param array $data
     * @return InventoryItem
     */
    public function transfer(array $data);

}
