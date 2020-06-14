<?php


namespace App\Repositories;


use App\DbModels\PaymentItemTransaction;
use App\Events\PaymentItemTransaction\PaymentItemTransactionUpdatedEvent;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentItemTransactionRepository;
use App\Services\Helpers\PaymentHelper;

class EloquentPaymentItemTransactionRepository extends EloquentBaseRepository implements PaymentItemTransactionRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pit.paymentItem' => 'paymentItem', 'pit.property' => 'property'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function generateTransaction(array $data): \ArrayAccess
    {
        $paymentItemRepository = app(PaymentItemRepository::class);

        $paymentItem = $paymentItemRepository->findOne($data['paymentItemId']);

        $transactionDetails = PaymentHelper::generatePaymentLink($paymentItem);

        $data['providerId'] = $transactionDetails['token'];
        $data['providerName'] = $transactionDetails['provider'];
        $data['paymentProcessURL'] = $transactionDetails['paymentURL'];
        $data['status'] = PaymentItemTransaction::STATUS_PENDING;

        return parent::save($data);
    }

    public function updateTransaction(PaymentItemTransaction $paymentItemTransaction, $token)
    {
        $paymentStatusDetails = PaymentHelper::getPaymentStatus($token);
        if ($paymentItemTransaction->status == PaymentItemTransaction::STATUS_PENDING) {
           if ($paymentStatusDetails['status'] == PaymentItemTransaction::STATUS_SUCCESS) {

               $paymentItemTransaction = $this->update($paymentItemTransaction, $paymentStatusDetails);

               event(new PaymentItemTransactionUpdatedEvent($paymentItemTransaction, $this->generateEventOptionsForModel()));
           }
        }

        return $paymentItemTransaction;
    }
}
