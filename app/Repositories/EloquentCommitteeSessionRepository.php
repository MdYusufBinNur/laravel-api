<?php


namespace App\Repositories;


use App\Repositories\Contracts\CommitteeSessionRepository;
use Carbon\Carbon;

class EloquentCommitteeSessionRepository extends EloquentBaseRepository implements CommitteeSessionRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['sessionDate'])) {
            $queryBuilder = $queryBuilder
                ->whereDate('startedDate', '<=', Carbon::parse($searchCriteria['sessionDate']))
                ->whereDate('endedDate', '>=', Carbon::parse($searchCriteria['sessionDate']));
            unset($searchCriteria['sessionDate']);
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['cs.property' => 'property', 'committee.committeeType' => 'committeeType'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);


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
