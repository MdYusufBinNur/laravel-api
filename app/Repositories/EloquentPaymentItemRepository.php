<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\UnitRepository;
use Illuminate\Support\Facades\DB;

class EloquentPaymentItemRepository extends EloquentBaseRepository implements PaymentItemRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pi.createdByUser' => 'createdByUser', 'pi.property' => 'property',  'pi.payment' => 'payment', 'pi.user' => 'user', 'pi.paymentItemLogs' => 'paymentItemLogs'];

        $loggedInUser = $this->getLoggedInUser();
        if (empty($searchCriteria['unitId']) && $loggedInUser->isResident()) {
            $searchCriteria['unitId'] = $loggedInUser->getResidentsUnitIdsOfTheProperty($searchCriteria['propertyId']);
        }

        return parent::findBy($searchCriteria, $withTrashed);
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

            if (!empty($payment->toUserIds)) {
                $userIds = $payment->toUserIds;
                foreach ($userIds as $userId) {
                    $data['userId'] = $userId;
                    $this->savePaymentItem($payment, $data);
                }
            }

            if (!empty($payment->toUnitIds)) {
                $unitIds = $this->getAllUnitIds($payment);

                foreach ($unitIds as $unitId) {
                    $data['unitId'] = $unitId;
                    $this->savePaymentItem($payment, $data);
                }
            }
        }

        DB::commit();
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
