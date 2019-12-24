<?php

namespace App\Listeners\Payment;

use App\Events\Payment\PaymentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentUpdatedEvent $event)
    {
        $payment = $event->payment;
        $eventOptions = $event->options;
        $oldPayment = $eventOptions['oldModel'];
    }
}
