<?php

namespace App\Listeners\PaymentItemPartial;

use App\DbModels\PaymentItem;
use App\Events\PaymentItemPartial\PaymentItemPartialUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemLogRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemPartialUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentItemRepository
     */
    private $paymentItemRepository;

    /**
     * @var PaymentItemLogRepository
     */
    private $paymentItemLogRepository;

    /**
     * HandlePaymentItemPartialCreatedEvent constructor.
     * @param PaymentItemRepository $paymentItemRepository
     * @param PaymentItemLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentItemRepository $paymentItemRepository, PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemRepository = $paymentItemRepository;
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Handle the event.
     *
     * @param PaymentItemPartialUpdatedEvent $event
     * @return void
     */
    public function handle(PaymentItemPartialUpdatedEvent $event)
    {
        $paymentItemPartial = $event->paymentItemPartial;
        $eventOptions = $event->options;
        $oldPaymentItemPartial = $eventOptions['oldModel'];

        $paymentItem = $paymentItemPartial->paymentItem;
        $totalAmount = $paymentItem->payment->amount;
        $totalAmountPaid = $paymentItem->paymentItemPartials->sum('amount');

        if ($totalAmountPaid >= $totalAmount) {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PAID]);
        } else {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PARTIAL]);
        }

        $this->logPartialPayment($paymentItemPartial->amount, $paymentItem, $eventOptions);

    }


    public function logPartialPayment($paymentItemPartial, $paymentItem, $eventOptions)
    {
        //log event
        $logData = [
            'paymentItemId' => $paymentItem->id,
            'propertyId' => $paymentItem->propertyId,
            'status' => $paymentItem->status,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'event' => 'partial.updated',
            'amount' => $paymentItemPartial->amount
        ];
        $this->paymentItemLogRepository->save($logData);
    }
}
