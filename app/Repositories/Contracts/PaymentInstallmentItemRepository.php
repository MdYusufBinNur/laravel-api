<?php


namespace App\Repositories\Contracts;


use App\DbModels\PaymentInstallment;

interface PaymentInstallmentItemRepository extends BaseRepository
{
    /**
     * set payment installment items
     *
     * @param PaymentInstallment $paymentInstallment
     * @param array $items
     */
    public function setPaymentInstallmentItems(PaymentInstallment $paymentInstallment, $items = array());

}
