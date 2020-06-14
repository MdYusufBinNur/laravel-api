<?php


namespace App\Repositories\Contracts;


interface PaymentItemTransactionRepository extends BaseRepository
{
    /**
     * generate a transaction
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function generateTransaction(array $data): \ArrayAccess;

}
