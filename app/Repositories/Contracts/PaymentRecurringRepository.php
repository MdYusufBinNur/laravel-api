<?php


namespace App\Repositories\Contracts;

interface PaymentRecurringRepository extends BaseRepository
{
    /**
     * set recurring payment
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setRecurringPayment(array $data): \ArrayAccess;
}
