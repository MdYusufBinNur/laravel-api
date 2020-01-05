<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Repositories\Contracts\PaymentRecurringRepository;
use Illuminate\Support\Arr;

class EloquentPaymentRecurringRepository extends EloquentBaseRepository implements PaymentRecurringRepository
{

    /**
     * @inheritDoc
     */
    public function setRecurringPayment(array $data): \ArrayAccess
    {
        $searchCriteria = Arr::only($data, ['propertyId', 'paymentId']);

        return $this->patch($searchCriteria, $data);
    }

}
