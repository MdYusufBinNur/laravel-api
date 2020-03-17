<?php


namespace App\Repositories;


use App\Repositories\Contracts\PaymentInstallmentRepository;

class EloquentPaymentInstallmentRepository extends EloquentBaseRepository implements PaymentInstallmentRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pim.createdByUser' => 'createdByUser', 'pim.payment' => 'payment'];

        return parent::findBy($searchCriteria, $withTrashed);
    }
}
