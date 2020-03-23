<?php


namespace App\Repositories;


use App\DbModels\PaymentInstallment;
use App\Repositories\Contracts\PaymentInstallmentItemRepository;

class EloquentPaymentInstallmentItemRepository extends EloquentBaseRepository implements PaymentInstallmentItemRepository
{
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
