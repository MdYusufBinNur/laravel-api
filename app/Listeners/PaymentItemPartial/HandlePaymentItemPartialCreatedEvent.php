<?php

namespace App\Listeners\PaymentItemPartial;

use App\DbModels\PaymentItem;
use App\Events\PaymentItemPartial\PaymentItemPartialCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemLogRepository;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemPartialCreatedEvent implements ShouldQueue
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
     * @param PaymentItemLogRepository $paymentItemLogRepository
     * @param PaymentItemRepository $paymentItemRepository
     */
    public function __construct(PaymentItemRepository $paymentItemRepository, PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemRepository = $paymentItemRepository;
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentItemPartialCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemPartialCreatedEvent $event)
    {
        $paymentItemPartial = $event->paymentItemPartial;
        $eventOptions = $event->options;
        $this->mergeRequestsForFutureEvents($eventOptions);

        $paymentItem = $paymentItemPartial->paymentItem;
        $totalAmount = $paymentItem->payment->amount;
        $totalAmountPaid = $paymentItem->paymentItemPartials->sum('amount');

        if ($totalAmountPaid >= $totalAmount) {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PAID]);
        } else {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PARTIAL]);
        }

        $this->logPaymentItem($paymentItemPartial, $paymentItem, $eventOptions);
    }

    public function logPaymentItem($paymentItemPartial, $paymentItem, $eventOptions)
    {
        //log event
        $logData = [
            'paymentItemId' => $paymentItem->id,
            'paymentItemPartialId' => $paymentItemPartial->id,
            'propertyId' => $paymentItem->propertyId,
            'status' => $paymentItem->status,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'event' => 'partial.added',
            'amount' => $paymentItemPartial->amount
        ];
        $this->paymentItemLogRepository->save($logData);
    }
}
