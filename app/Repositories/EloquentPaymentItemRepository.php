<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\DbModels\PaymentInstallment;
use App\DbModels\PaymentInstallmentItem;
use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\UnitRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EloquentPaymentItemRepository extends EloquentBaseRepository implements PaymentItemRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $thisModelTable = $this->model->getTable();
        $paymentTable = Payment::getTableName();

        $queryBuilder = $this->model
            ->select($thisModelTable . '.*')
            ->join($paymentTable, $thisModelTable . '.paymentId', '=', $paymentTable . '.id');

        if (empty($searchCriteria['unitId'])) {
            $loggedInUser = $this->getLoggedInUser();
            if ($loggedInUser->isOnlyResidentOfTheProperty($searchCriteria['propertyId'])) {
                $searchCriteria['unitId'] = $loggedInUser->getResidentsUnitIdsOfTheProperty($searchCriteria['propertyId']);
            }
        }

        if (isset($searchCriteria['paymentTypeId'])) {
            $queryBuilder = $queryBuilder->where($paymentTable . '.paymentTypeId', $searchCriteria['paymentTypeId']);
            unset($searchCriteria['paymentTypeId']);
        }

        if (isset($searchCriteria['endDate'])) {
            $queryBuilder = $queryBuilder->whereDate($thisModelTable . '.created_at', '<=', Carbon::parse($searchCriteria['endDate']));
            unset($searchCriteria['endDate']);
        }

        if (isset($searchCriteria['startDate'])) {
            $queryBuilder = $queryBuilder->whereDate($thisModelTable . '.created_at', '>=', Carbon::parse($searchCriteria['startDate']));
            unset($searchCriteria['startDate']);
        }

        foreach ($searchCriteria as $key => $value) {
            if ($key != 'include') {
                $searchCriteria[$thisModelTable . '.' . $key] = $value;
                unset($searchCriteria[$key]);
            }
        }

        $queryBuilder = $queryBuilder->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        $searchCriteria['eagerLoad'] = ['pi.createdByUser' => 'createdByUser', 'pi.property' => 'property', 'pi.payment' => 'payment', 'pi.user' => 'user', 'pi.unit' => 'unit', 'pi.vendor' => 'vendor', 'pi.customer' => 'customer', 'pi.paymentItemLogs' => 'paymentItemLogs', 'pi.paymentItemPartials' => 'paymentItemPartials', 'pi.paymentInstallmentItem' => 'paymentInstallmentItem'];
        $this->applyEagerLoad($queryBuilder, $searchCriteria);

        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 15;
        $orderBy = !empty($searchCriteria['order_by']) ? $thisModelTable . '.' . $searchCriteria['order_by'] : $thisModelTable . '.id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder->orderBy($orderBy, $orderDirection);
        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $paymentItem = parent::save($data);

        event(new PaymentItemCreatedEvent($paymentItem, $this->generateEventOptionsForModel()));

        return $paymentItem;
    }

    /**
     * @inheritDoc
     */
    public function savePaymentItem(Payment $payment, array $data): \ArrayAccess
    {
        //todo filter out duplicate payment item
        return $this->save($data);
    }

    /**
     * @inheritDoc
     */
    public function publishPayment(Payment $payment, array $options = [])
    {
        DB::beginTransaction();

        if ($payment->isPublishAble()) {

            $data = [
                'propertyId' => $payment->propertyId,
                'paymentId' => $payment->id,
            ];

            if ($payment->isInstallment) {
                $paymentInstallment = $payment->paymentInstallment;
                if ($paymentInstallment instanceof PaymentInstallment) {
                    $paymentInstallmentItems = $paymentInstallment->paymentInstallmentItems;
                    foreach ($paymentInstallmentItems as $paymentInstallmentItem) {
                        $data['paymentInstallmentItemId'] = $paymentInstallmentItem->id;
                        $this->setPaymentItem($payment, $data);
                    }
                } else {
                    throw new \ErrorException("Couldn't find the payment installment of payment id: " . $payment->id);
                }
            } else {
                $this->setPaymentItem($payment, $data);
            }
        }

        DB::commit();
    }

    private function setPaymentItem($payment, $data)
    {
        if (!empty($payment->toUserIds)) {
            $userIds = $payment->toUserIds;
            foreach ($userIds as $userId) {
                $data['userId'] = $userId;
                $this->savePaymentItem($payment, $data);
            }
        }

        if (!empty($payment->toUnitIds)) {
            $vendorIds = $this->getAllUnitIds($payment);

            foreach ($vendorIds as $unitId) {
                $data['unitId'] = $unitId;
                $this->savePaymentItem($payment, $data);
            }
        }

        if (!empty($payment->toCustomerIds)) {
            $customerIds = $payment->toCustomerIds;

            foreach ($customerIds as $customerId) {
                $data['customerId'] = $customerId;
                $this->savePaymentItem($payment, $data);
            }
        }

        if (!empty($payment->toVendorIds)) {
            $vendorIds = $payment->toVendorIds;

            foreach ($vendorIds as $vendorId) {
                $data['vendorId'] = $vendorId;
                $this->savePaymentItem($payment, $data);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $paymentItem = parent::update($model, $data);

        event(new PaymentItemUpdatedEvent($paymentItem, $this->generateEventOptionsForModel()));

        return $paymentItem;
    }

    /**
     * @inheritDoc
     */
    public function setPaymentItemOfPaymentInstallmentItem(PaymentInstallmentItem $paymentInstallmentItem)
    {
        $payment = $paymentInstallmentItem->paymentInstallment->payment;
        $data = [
            'paymentId' => $payment->id,
            'propertyId' => $paymentInstallmentItem->propertyId,
            'paymentInstallmentItemId' => $paymentInstallmentItem->id
        ];
        $this->setPaymentItem($payment, $data);

    }

    /**
     * get unitIds
     *
     * @param $payment
     * @return mixed
     */
    private function getAllUnitIds($payment)
    {
        $unitIds = $payment->toUnitIds;

        if (in_array('all_units', $unitIds)) {
            $unitRepository = app(UnitRepository::class);
            $unitIds = $unitRepository->getAllUnitIdsByPropertyId($payment->propertyId);
        }

        return $unitIds;

    }
}
