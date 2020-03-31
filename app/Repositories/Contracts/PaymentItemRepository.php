<?php


namespace App\Repositories\Contracts;


use App\DbModels\Payment;
use App\DbModels\PaymentInstallmentItem;

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

    /**
     * set payment-item using installment-item
     *
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return mixed
     */
    public function setPaymentItemOfPaymentInstallmentItem(PaymentInstallmentItem $paymentInstallmentItem);

}
