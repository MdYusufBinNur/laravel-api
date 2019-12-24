<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentItemUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemUpdatedEvent $event)
    {
        $paymentItem = $event->paymentItem;
        $eventOptions = $event->options;
        $oldPaymentItem = $eventOptions['oldModel'];
    }
}
