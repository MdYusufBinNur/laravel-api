<?php


namespace App\Repositories;


use App\DbModels\PaymentInstallment;
use App\Repositories\Contracts\PaymentInstallmentItemRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Support\Facades\DB;

class EloquentPaymentInstallmentItemRepository extends EloquentBaseRepository implements PaymentInstallmentItemRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pimi.createdByUser' => 'createdByUser', 'pimi.paymentInstallment' => 'paymentInstallment',  'pimi.payment' => 'payment'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $paymentInstallmentItem = parent::save($data);

        $paymentItemRepository = app(PaymentItemRepository::class);
        $paymentItemRepository->setPaymentItemOfPaymentInstallmentItem($paymentInstallmentItem);

        DB::commit();

        return $paymentInstallmentItem;
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        DB::beginTransaction();

        $paymentItemRepository = app(PaymentItemRepository::class);
        $paymentItemRepository->delete($model->paymentItem);

        $isDeleted = parent::delete($model);

        DB::commit();

        return $isDeleted;
    }

    /**
     * @inheritDoc
     */
    public function setPaymentInstallmentItems(PaymentInstallment $paymentInstallment, $items = array())
    {
        foreach ($items as $item) {
            $data = [
                'propertyId' => $paymentInstallment->propertyId,
                'paymentInstallmentId' => $paymentInstallment->id,
                'dueDate' => $item['dueDate'],
                'amount' => $item['amount'],
            ];
            parent::save($data);
        }

    }
}
