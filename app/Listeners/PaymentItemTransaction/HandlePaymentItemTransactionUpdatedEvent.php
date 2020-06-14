<?php

namespace App\Listeners\PaymentItemTransaction;

use App\DbModels\PaymentItem;
use App\DbModels\PaymentItemTransaction;
use App\Events\PaymentItemTransaction\PaymentItemTransactionUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemTransactionUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentItemTransactionUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemTransactionUpdatedEvent $event)
    {
        $paymentItemTransaction = $event->paymentItemTransaction;
        $eventOptions = $event->options;
        $oldPaymentItemTransaction = $eventOptions['oldModel'];

        if ($paymentItemTransaction->status == PaymentItemTransaction::STATUS_SUCCESS) {
            $paymentItem = $paymentItemTransaction->paymentItem;
            $paymentItemRepository = app(PaymentItemRepository::class);
            $paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_PAID]);
        }
    }
}
