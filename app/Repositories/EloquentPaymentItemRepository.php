<?php


namespace App\Repositories;


use App\DbModels\Payment;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\UnitRepository;
use Carbon\Carbon;

class EloquentPaymentItemRepository extends EloquentBaseRepository implements PaymentItemRepository
{
    /**
     * @inheritDoc
     */
    public function saveByPayment(Payment $payment)
    {
        if (!$payment->hasPublished() && $payment->hasActivationDatePassed()) {
            $data = [
                'propertyId' => $payment->propertyId,
                'paymentId' => $payment->id,
            ];

            if (isset($payment->toUserIds)) {
                $userIds = $payment->toUserIds;
                foreach ($userIds as $userId) {
                    $data['userId'] = $userId;
                    $this->save($data);
                }
            }

            if (isset($payment->toUnitIds)) {
             $unitIds = $this->getAllUnitIds($payment);

             foreach ($unitIds as $unitId) {
                 $data['unitId'] = $unitId;
                 $this->save($data);
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
