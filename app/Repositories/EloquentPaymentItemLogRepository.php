<?php


namespace App\Repositories;


use App\Repositories\Contracts\PaymentItemLogRepository;

class EloquentPaymentItemLogRepository extends EloquentBaseRepository implements PaymentItemLogRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        $searchCriteria['eagerLoad'] = ['pil.createdByUser' => 'createdByUser', 'pil.property' => 'property',  'pil.payment' => 'payment', 'pil.user' => 'user'];

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
