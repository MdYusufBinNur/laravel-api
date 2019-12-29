<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Repositories\Contracts\PaymentRecurringRepository;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['payment.createdByUser' => 'createdByUser', 'payment.property' => 'property',  'payment.paymentMethod' => 'paymentMethod', 'payment.paymentType' => 'paymentType', 'payment.paymentItems' => 'paymentItems'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function savePayment(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $payment = $this->save($data);

        //is it recurring?
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

    /**
     * @inheritDoc
     */
    public function updatePayment(Payment $model, array $data): \ArrayAccess
    {
        $this->validatePaymentChanges($model, $data);

        $payment = parent::update($model, $data);

        event(new PaymentUpdatedEvent($model, $this->generateEventOptionsForModel()));

        return $payment;
    }

    /**
     * validate payment changes
     *
     * @param Payment $payment
     * @param array $data
     * @throws ValidationException
     */
    private function validatePaymentChanges(Payment $payment, array $data)
    {
        if (!$payment->isUpdateAble()) {
            throw ValidationException::withMessages([
                'status' => ["Payment is already in process. You can't update it"]
            ]);
        }
    }
}
