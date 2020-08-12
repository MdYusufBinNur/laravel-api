<?php


namespace App\Repositories;


use App\Events\Package\PackageCreatedEvent;
use App\Events\Package\PackageUpdatedEvent;
use App\Repositories\Contracts\LdsBlacklistUnitRepository;
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

        $searchCriteria['eagerLoad'] = ['package.property' => 'property', 'package.type' => 'type', 'package.resident' => 'resident', 'package.unit' => 'unit', 'package.enteredUser' => 'enteredUser'];

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        if ($withTrashed) {
            $queryBuilder->withTrashed();
        }

        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }
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

    /**
     * @inheritDoc
     */
    public function getPackagesForLds(array $searchCriteria)
    {
        //get all blacklisted units first
        $ldsBlacklistUnitRepository = app(LdsBlacklistUnitRepository::class);
        $ldsBlacklistUnitIds = $ldsBlacklistUnitRepository->model->where('propertyId', $searchCriteria['propertyId'])->pluck('id')->toArray();

        $queryBuilder = $this->model
            ->whereNotIn('unitId', $ldsBlacklistUnitIds)
            ->where('propertyId', $searchCriteria['propertyId']);

        if (isset($searchCriteria['include'])) {
            $searchCriteria['eagerLoad'] = ['package.property' => 'property', 'package.type' => 'type', 'package.resident' => 'resident', 'package.unit' => 'unit', 'package.enteredUser' => 'enteredUser'];
            $includedRelationships = $this->eagerLoadWithIncludeParam($searchCriteria['include'], $searchCriteria['eagerLoad']);
            $queryBuilder->with($includedRelationships);
        }

        return $queryBuilder->get();

    }
}
