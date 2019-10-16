<?php


namespace App\Repositories;


use App\DbModels\ParkingSpace;
use App\Repositories\Contracts\ParkingPassRepository;
use App\Repositories\Contracts\ParkingSpaceRepository;
use Carbon\Carbon;

class EloquentParkingPassRepository extends EloquentBaseRepository implements ParkingPassRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('endAt', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('startAt', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        if (isset($searchCriteria['releasedStartDate'])) {
            $queryBuilder = $queryBuilder->whereDate('releasedAt', '>=', Carbon::parse($searchCriteria['releasedStartDate']));
            unset($searchCriteria['releasedStartDate']);
        }

        if (isset($searchCriteria['releasedEndDate'])) {
            $queryBuilder = $queryBuilder->whereDate('releasedAt', '<=', Carbon::parse($searchCriteria['releasedEndDate']));
            unset($searchCriteria['releasedEndDate']);
        }

        $searchCriteria['eagerLoad'] = ['pp.unit' => 'unit', 'pp.space' => 'parkingSpace', 'pp.releasedByUser' => 'releasedByUser', 'pp.createdByUser' => 'createdByUser'];

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        if (!isset($data['startDate'])) {
            $data['startDate'] = Carbon::now();
        }

        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $parkingSpace = $parkingSpaceRepository->findOne($data['spaceId']);
        if ($parkingSpace instanceof ParkingSpace) {
            $data['propertyId'] = $parkingSpace->propertyId;
        }

        return parent::save($data);
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        if (isset($data['released'])) {
            if ($data['released']) {
                $data['releasedAt'] = Carbon::now();
                $data['releasedByUserId'] = $this->getLoggedInUser()->id;
            } else {
                $data['releasedAt'] = null;
                $data['releasedByUserId'] = null;
            }

            unset($data['released']);
            // todo log

        }

        return parent::update($model, $data);
    }
}
