<?php


namespace App\Repositories;


use App\Events\Payment\PaymentCreatedEvent;
use App\Repositories\Contracts\PaymentRecurringRepository;
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

        //is recurring?
        if (!empty($data['isRecurring'])) {
            $paymentRecurringRepository = app(PaymentRecurringRepository::class);
            $paymentRecurringRepository->save([
                'propertyId'=> $payment->propertyId,
                'paymentId' => $payment->id,
                'activationDate' => $payment->activationDate,
                'expireDate' => $data['expireDate'],
                'period' => $data['period']
            ]);
        }

        event(new PaymentCreatedEvent($payment, $this->generateEventOptionsForModel()));

        DB::commit();

        return $payment;
    }
}
