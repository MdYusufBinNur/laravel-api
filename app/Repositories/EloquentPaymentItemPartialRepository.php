<?php


namespace App\Repositories;


use App\Events\PaymentItemPartial\PaymentItemPartialCreatedEvent;
use App\Events\PaymentItemPartial\PaymentItemPartialDeletedEvent;
use App\Repositories\Contracts\PaymentItemPartialRepository;

class EloquentPaymentItemPartialRepository extends EloquentBaseRepository implements PaymentItemPartialRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['pip.createdByUser' => 'createdByUser', 'pip.paymentItem' => 'paymentItem', 'pip.paymentMethod' => 'paymentMethod'];

        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        $paymentItemPartial = parent::save($data);

        event(new PaymentItemPartialCreatedEvent($paymentItemPartial, $this->generateEventOptionsForModel()));

        return $paymentItemPartial;
    }

    /**
     * @inheritDoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        $hasDeleted = parent::delete($model);
        event(new PaymentItemPartialDeletedEvent($model, $this->generateEventOptionsForModel()));

        return $hasDeleted;
    }
}
