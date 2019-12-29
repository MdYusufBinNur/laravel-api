<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\UnitRepository;

class EloquentPaymentItemRepository extends EloquentBaseRepository implements PaymentItemRepository
{
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
