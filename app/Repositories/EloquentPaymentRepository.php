<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\DbModels\PaymentInstallment;
use App\DbModels\PaymentItem;
use App\DbModels\PaymentRecurring;
use App\Events\Payment\PaymentCreatedEvent;
use App\Events\Payment\PaymentUpdatedEvent;
use App\Repositories\Contracts\PaymentInstallmentRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
use App\Repositories\Contracts\PaymentRecurringRepository;
use App\Repositories\Contracts\PaymentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EloquentPaymentRepository extends EloquentBaseRepository implements PaymentRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $queryBuilder = $this->model;

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate('created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        if (!empty($searchCriteria['toUnitIds'])) {
            $queryBuilder = $this->applySearchInJsonField($queryBuilder, 'toUnitIds', $searchCriteria['toUnitIds']);
            unset($searchCriteria['toUnitIds']);
        };

        if (!empty($searchCriteria['toUserIds'])) {
            $queryBuilder = $this->applySearchInJsonField($queryBuilder, 'toUnitIds', $searchCriteria['toUserIds']);
            unset($searchCriteria['toUserIds']);

        };

        if (!empty($searchCriteria['toVendorIds'])) {
            $queryBuilder = $this->applySearchInJsonField($queryBuilder, 'toVendorIds', $searchCriteria['toVendorIds']);
            unset($searchCriteria['toVendorIds']);
        };

        if (!empty($searchCriteria['toCustomerIds'])) {
            $queryBuilder = $this->applySearchInJsonField($queryBuilder, 'toCustomerIds', $searchCriteria['toVendorIds']);
            unset($searchCriteria['toCustomerIds']);
        };

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        $searchCriteria['eagerLoad'] = ['payment.createdByUser' => 'createdByUser', 'payment.property' => 'property', 'payment.paymentPaymentMethods' => 'paymentPaymentMethods', 'payment.paymentType' => 'paymentType', 'payment.paymentItems' => 'paymentItems', 'payment.paymentRecurring' => 'paymentRecurring','payment.paymentInstallment' => 'paymentInstallment', 'pp.createdByUser' => 'createdByUser', 'ppm.paymentMethod' => 'paymentPaymentMethods.paymentMethod'];
        $queryBuilder = $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);

        if (empty($searchCriteria['withOutPagination'])) {
            return $queryBuilder->paginate($limit);
        } else {
            return $queryBuilder->get();
        }
    }

    /**
     * @inheritDoc
     */
    public function savePayment(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $payment = $this->save($data);

        //is it recurring?
        $this->setRecurringPayment($payment, $data);

        $this->setInstallmentPayment($payment, $data);

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
     * set payment methods
     * @param $payment
     * @param $data
     */
    private function setRecurringPayment($payment, $data)
    {
        $paymentRecurringRepository = app(PaymentRecurringRepository::class);
        if (isset($data['isRecurring'])) {
            if ($data['isRecurring'] == 1) {
                $paymentRecurringRepository->setRecurringPayment([
                    'propertyId' => $payment->propertyId,
                    'paymentId' => $payment->id,
                    'activationDate' => $payment->activationDate,
                    'expireDate' => $data['expireDate'],
                    'period' => $data['period']
                ]);
            } else if ($data['isRecurring'] == 0) {
                $paymentRecurring = $payment->paymentRecurring;
                if ($paymentRecurring instanceof PaymentRecurring) {
                    $paymentRecurringRepository->delete($paymentRecurring);
                }
            }
        }
    }

    /**
     * set payment methods
     * @param $payment
     * @param $data
     */
    private function setInstallmentPayment($payment, $data)
    {
        $paymentInstallmentRepository = app(PaymentInstallmentRepository::class);

        if (isset($data['isInstallment'])) {
            if ($data['isInstallment'] == 1) {

                $paymentInstallmentRepository->save([
                    'propertyId' => $payment->propertyId,
                    'paymentId' => $payment->id,
                    'numberOfInstallments' => $data['installments']['numberOfInstallments'],
                    'items' => $data['installments']['items'],
                ]);
            } else if ($data['isInstallment'] == 0) {
                $paymentInstallment = $payment->paymentInstallment;
                if ($paymentInstallment instanceof PaymentInstallment) {
                    $paymentInstallmentRepository->delete($paymentInstallment);
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function updatePayment(Payment $model, array $data): \ArrayAccess
    {
        $this->validatePaymentChanges($model, $data);

        DB::beginTransaction();

        $payment = $this->update($model, $data);

        //is it recurring?
        $this->setRecurringPayment($payment, $data);

        $this->setPaymentMethods($payment, $data);

        DB::commit();

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
        if (!(isset($data['status']))) {
            if (!$payment->isUpdateAble()) {
                throw ValidationException::withMessages([
                    'status' => ["Payment is already in process. You can't update it"]
                ]);
            }
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
