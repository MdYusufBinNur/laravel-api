<?php

namespace App\Listeners\PaymentItemPartial;

use App\DbModels\PaymentItem;
use App\Events\PaymentItemPartial\PaymentItemPartialCreatedEvent;
use App\Listeners\CommonListenerFeatures;
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
     * HandlePaymentItemPartialCreatedEvent constructor.
     * @param PaymentItemRepository $paymentItemRepository
     */
    public function __construct(PaymentItemRepository $paymentItemRepository)
    {
        $this->paymentItemRepository = $paymentItemRepository;
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

        $paymentItem = $paymentItemPartial->paymentItem;
        $totalAmount = $paymentItem->payment->amount;
        $totalAmountPaid = $paymentItem->paymentItemPartials->sum('amount');

        if ($totalAmountPaid >= $totalAmount) {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PAID]);
        } else {
            $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PARTIAL]);
        }
    }
}
