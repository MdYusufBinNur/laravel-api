<?php


namespace App\Repositories;


use App\Events\Package\PackageCreatedEvent;
use App\Events\Package\PackageUpdatedEvent;
use App\Repositories\Contracts\PackageRepository;
use Carbon\Carbon;

class EloquentPackageRepository extends EloquentBaseRepository implements PackageRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        //todo search by unitId, keyword
        
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
        $queryBuilder->with(['type','resident','unit', 'enteredUser']);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        $data['enteredUserId'] = $this->getLoggedInUser()->id;
        $package = parent::save($data);

        event(new PackageCreatedEvent($package, $this->generateEventOptionsForModel()));

        return $package;
    }

    /**
     * @inheritdoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $package = parent::update($model, $data);

        event(new PackageUpdatedEvent($package, $this->generateEventOptionsForModel()));

        return $package;
    }

}
