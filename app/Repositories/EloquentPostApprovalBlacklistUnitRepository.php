<?php


namespace App\Repositories;


use App\DbModels\Post;
use App\DbModels\PostApprovalBlacklistUnit;
use App\DbModels\Resident;
use App\DbModels\Unit;
use App\Repositories\Contracts\PostApprovalBlacklistUnitRepository;

class EloquentPostApprovalBlacklistUnitRepository extends EloquentBaseRepository implements PostApprovalBlacklistUnitRepository
{
    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $unit = Unit::getTableName();

        $queryBuilder = $this->model
            ->select($thisModelTable . '.*')
            ->join($unit, $thisModelTable . '.unitId', '=', $unit . '.id');

        if (isset($searchCriteria['propertyId'])) {
            $queryBuilder = $queryBuilder->where($unit . '.propertyId', $searchCriteria['propertyId']);
            unset($searchCriteria['propertyId']);
        }

        foreach ($searchCriteria as $key => $value) {
            if (in_array($key, ['unit'])) {
                $searchCriteria[$thisModelTable . '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['pabu.unit' => 'unit'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $thisModelTable . '.' . $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function isTheUserBlacklisted($propertyId, $user = null)
    {
        $user = $user ?? $this->getLoggedInUser();

        $resident = $user->scopeResidentOfTheProperty($propertyId)->first();

        if ($resident instanceof Resident) {
            $postApprovalBlacklistUnit = $this->findOneBy(['unitId' => $resident->unitId]);

            return $postApprovalBlacklistUnit instanceof PostApprovalBlacklistUnit;
        }

        return false;
    }

}
