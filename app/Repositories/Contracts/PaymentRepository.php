<?php


namespace App\Repositories\Contracts;


interface PaymentRepository extends BaseRepository
{
    /**
     * save a payment
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function savePayment(array $data): \ArrayAccess;
}
