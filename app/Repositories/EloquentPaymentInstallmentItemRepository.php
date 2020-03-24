<?php


namespace App\Repositories;


use App\DbModels\PaymentInstallment;
use App\Repositories\Contracts\PaymentInstallmentItemRepository;

class EloquentPaymentInstallmentItemRepository extends EloquentBaseRepository implements PaymentInstallmentItemRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pimi.createdByUser' => 'createdByUser', 'pimi.paymentInstallment' => 'paymentInstallment',  'pimi.payment' => 'payment'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function setPaymentInstallmentItems(PaymentInstallment $paymentInstallment, $items = array())
    {
        foreach ($items as $item) {
            $data = [
                'propertyId' => $paymentInstallment->propertyId,
                'paymentInstallmentId' => $paymentInstallment->id,
                'dueDate' => $item['dueDate'],
                'amount' => $item['amount'],
            ];
            parent::save($data);
        }

    }
}
