<?php


namespace App\Repositories\Contracts;


use App\DbModels\Payment;

interface PaymentItemRepository extends BaseRepository
{
    /**
     * save a payment item
     *
     * @param Payment $payment
     * @param array $data
     * @return \ArrayAccess
     */
    public function savePaymentItem(Payment $payment, array $data): \ArrayAccess;

    /**
     * create payment-items by payment
     *
     * @param Payment $payment
     * @param array $options
     * @return mixed
     */
    public function publishPayment(Payment $payment, array $options = []);

}
