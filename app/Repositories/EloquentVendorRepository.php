<?php


namespace App\Repositories;


use App\Repositories\Contracts\VendorRepository;
use Carbon\Carbon;

class EloquentVendorRepository extends EloquentBaseRepository implements VendorRepository
{

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;
        if (isset($searchCriteria['query'])) {
            $queryBuilder = $queryBuilder
                ->where('name', 'like', '%'.$searchCriteria['query'].'%')
                ->orwhere('email', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('phone', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('address', 'like', '%'.$searchCriteria['query'].'%');
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
