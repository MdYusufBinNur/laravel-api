<?php


namespace App\Repositories;


use App\DbModels\ParkingSpace;
use App\Events\ParkingPass\ParkingPassCreatedEvent;
use App\Events\ParkingPass\ParkingPassUpdatedEvent;
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
        if (isset($data['startAt'])) {
            $data['startAt'] = Carbon::parse($data['startAt']);
        } else {
            $data['startDate'] = Carbon::now();
        }

        if (isset($data['endAt'])) {
            $data['endAt'] = Carbon::parse($data['endAt']);
        }


        $parkingSpaceRepository = app(ParkingSpaceRepository::class);
        $parkingSpace = $parkingSpaceRepository->findOne($data['spaceId']);
        if ($parkingSpace instanceof ParkingSpace) {
            $data['propertyId'] = $parkingSpace->propertyId;
        }

        $parkingPass = parent::save($data);

        event(new ParkingPassCreatedEvent($parkingPass, $this->generateEventOptionsForModel()));


        return $parkingPass;
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
                $data['deleted_at'] = Carbon::now();
            } else {
                $data['releasedAt'] = null;
                $data['releasedByUserId'] = null;
            }

            unset($data['released']);
            // todo log

        }

        if (isset($data['startAt'])) {
            $data['startAt'] = Carbon::parse($data['startAt']);
        }

        if (isset($data['endAt'])) {
            $data['endAt'] = Carbon::parse($data['endAt']);
        }

        $parkingPass = parent::update($model, $data);

        if (isset($data['deleted_at'])) {
            parent::delete($parkingPass); // also delete the parking pass
        }

        event(new ParkingPassUpdatedEvent($parkingPass, $this->generateEventOptionsForModel()));

        return $parkingPass;
    }

    /**
     * delete a parking pass
     *
     * @param \ArrayAccess $model
     * @return bool
     */
    public function delete(\ArrayAccess $model): bool
    {
        $this->update($model, ['released' => true]);

        return true;
    }
}
