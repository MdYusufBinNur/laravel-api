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
        $searchCriteria['eagerLoad'] = ['pil.createdByUser' => 'createdByUser', 'pil.property' => 'property',  'pil.payment' => 'payment', 'pil.user' => 'user'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

}
