<?php


namespace App\Repositories\Contracts;


use App\DbModels\Payment;

interface PaymentItemRepository extends BaseRepository
{
    /**
     * create payment-items by payment
     *
     * @param Payment $payment
     * @return mixed
     */
    public function saveByPayment(Payment $payment);

}
