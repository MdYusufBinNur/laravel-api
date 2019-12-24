<?php

namespace App\Listeners\PaymentItemLog;

use App\Events\PaymentItemLog\PaymentItemLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentItemLogCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemLogCreatedEvent $event)
    {
        $paymentItemLog = $event->paymentItemLog;
        $eventOptions = $event->options;
    }
}
