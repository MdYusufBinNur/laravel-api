<?php


namespace App\Repositories;


use App\Repositories\Contracts\PaymentInstallmentItemRepository;
use App\Repositories\Contracts\PaymentInstallmentRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EloquentPaymentInstallmentRepository extends EloquentBaseRepository implements PaymentInstallmentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $paymentInstallment = parent::save($data);

        $paymentInstallmentItemRepository = app(PaymentInstallmentItemRepository::class);
        $paymentInstallmentItemRepository->setPaymentInstallmentItems($paymentInstallment, $data['items']);

        DB::commit();

        return $paymentInstallment;
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pim.createdByUser' => 'createdByUser', 'pim.payment' => 'payment'];

        return parent::findBy($searchCriteria, $withTrashed);
    }
}
