<?php


namespace App\Repositories;


use App\Events\InventoryItemLog\InventoryItemLogCreatedEvent;
use App\Repositories\Contracts\InventoryItemLogRepository;
use Carbon\Carbon;

class EloquentInventoryItemLogRepository extends EloquentBaseRepository implements InventoryItemLogRepository
{
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

        $searchCriteria['eagerLoad'] = ['iil.inventoryItem' => 'inventoryItem', 'iil.vendor' => 'vendor','iil.expense' => 'expense', 'iil.updatedByUser' => 'updatedByUser'];
        $queryBuilder = $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }
    }

    public function save(array $data): \ArrayAccess
    {
        $inventoryItemLog =  parent::save($data);

        event(new InventoryItemLogCreatedEvent($inventoryItemLog, $this->generateEventOptionsForModel()));

        return $inventoryItemLog;
    }

}
