<?php


namespace App\Repositories\Contracts;


use App\DbModels\PaymentItemTransaction;

interface PaymentItemTransactionRepository extends BaseRepository
{
    /**
     * generate a transaction
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function generateTransaction(array $data): \ArrayAccess;

    /**
     * update a transaction
     *
     * @param PaymentItemTransaction $paymentItemTransaction
     * @param $token
     * @return PaymentItemTransaction|\ArrayAccess
     */
    public function updateTransaction(PaymentItemTransaction $paymentItemTransaction, $token)''

}
