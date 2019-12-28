<?php


namespace App\Repositories;


use App\Repositories\Contracts\PaymentMethodRepository;

class EloquentPaymentMethodRepository extends EloquentBaseRepository implements PaymentMethodRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 50; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['']) ? $searchCriteria['order_direction'] : 'desc';

        $queryBuilder = $this->model->whereNull('propertyId');
        $queryBuilder->orWhere(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        if ($withTrashed) {
            $queryBuilder->withTrashed();
        }

        $queryBuilder = $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $queryBuilder->orderBy($orderBy, $orderDirection);

        return $queryBuilder->paginate($limit);
    }

}
