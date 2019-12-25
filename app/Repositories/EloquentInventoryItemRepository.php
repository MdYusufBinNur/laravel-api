<?php


namespace App\Repositories;


use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Repositories\Contracts\InventoryItemRepository;
use Carbon\Carbon;

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

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
