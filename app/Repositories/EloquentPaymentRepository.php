<?php


namespace App\Repositories;


use App\Events\Payment\PaymentCreatedEvent;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Support\Facades\DB;

class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepository
{
    /**
     * @inheritDoc
     */
    public function savePayment(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $payment = parent::save($data);

        event(new PaymentCreatedEvent($payment, $this->generateEventOptionsForModel()));

        DB::commit();

        return $payment;
    }
}
