<?php

namespace App\Listeners\PaymentItemLog;

use App\Events\PaymentItemLog\PaymentItemLogUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemLogUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentItemLogUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemLogUpdatedEvent $event)
    {
        $paymentItemLog = $event->paymentItemLog;
        $eventOptions = $event->options;
        $oldPaymentItemLog = $eventOptions['oldModel'];
    }
}
