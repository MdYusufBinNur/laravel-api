<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
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
        $searchCriteria['eagerLoad'] = ['payment.createdByUser' => 'createdByUser', 'payment.property' => 'property',  'payment.paymentPaymentMethods' => 'paymentPaymentMethods', 'payment.paymentType' => 'paymentType', 'payment.paymentItems' => 'paymentItems','payment.paymentRecurring' => 'paymentRecurring', 'pp.createdByUser' => 'createdByUser', 'ppm.paymentMethod' => 'paymentPaymentMethods.paymentMethod'];

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

        $this->setPaymentMethods($payment, $data);

        DB::commit();

        event(new PaymentCreatedEvent($payment, $this->generateEventOptionsForModel()));

        return $payment;
    }

    /**
     * set payment methods
     * @param $payment
     * @param $data
     */
    private function setPaymentMethods($payment, $data)
    {
        if (isset($data['paymentMethodIds'])) {

            $paymentPaymentMethodRepository = app(PaymentPaymentMethodRepository::class);
            $paymentPaymentMethodRepository->setPaymentMethods($payment, $data['paymentMethodIds']);
        }
    }
    /**
     * @inheritDoc
     */
    public function updatePayment(Payment $model, array $data): \ArrayAccess
    {
        $this->validatePaymentChanges($model, $data);

        $payment = $this->update($model, $data);

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

    /**
     * @inheritDoc
     */
    public function removePayment(Payment $payment): bool
    {
        DB::beginTransaction();

        $paymentItemRepository = app(PaymentItemRepository::class);

        $paymentItems = $payment->paymentItems;
        foreach ($paymentItems as $paymentItem) {
            if (!$paymentItem->isPaid()) {
                $paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_CANCELLED]);
            }
        }
        $hasDeleted = $this->update($payment, ['status' => Payment::STATUS_CANCELLED]);

        DB::commit();

        return $hasDeleted instanceof Payment;
    }
}
