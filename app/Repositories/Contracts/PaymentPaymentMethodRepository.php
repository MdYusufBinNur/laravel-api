<?php


namespace App\Repositories\Contracts;


use App\DbModels\Payment;

interface PaymentPaymentMethodRepository extends BaseRepository
{
    /**
     * set module property
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setPaymentMethods(Payment $payment, array $data): \ArrayAccess;

}
