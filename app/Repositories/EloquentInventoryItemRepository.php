<?php


namespace App\Repositories;


use App\Events\InventoryItem\InventoryItemCreatedEvent;
use App\Events\InventoryItem\InventoryItemUpdatedEvent;
use App\Repositories\Contracts\ExpenseRepository;
use App\Repositories\Contracts\InventoryItemRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentInventoryItemRepository extends EloquentBaseRepository implements InventoryItemRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $inventoryItem = parent::save($data);

        event(new InventoryItemCreatedEvent($inventoryItem, $this->generateEventOptionsForModel()));

        DB::commit();

        return $inventoryItem;
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $inventoryItem = parent::update($model, $data);

        if (!empty($data['cost'])) {
            $expenseRepository = app(ExpenseRepository::class);
            $expenseRepository->save(['categoryId' => 1, 'amount' => $data['cost'], 'expenseDate' => Carbon::today(), 'propertyId' => $data['propertyId'], 'expenseReason' => 'Expense from Inventory# ' . $inventoryItem->id]);
        }

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

        if (isset($searchCriteria['query'])) {
            $queryBuilder = $queryBuilder->where('name', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('sku', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('manufacturer', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('location', 'like', '%' . $searchCriteria['query'] . '%')
                ->orWhere('restockNote', 'like', '%' . $searchCriteria['query'] . '%');
            unset($searchCriteria['query']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

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

}
