<?php

namespace App\Listeners\PaymentRecurring;

use App\Events\PaymentRecurring\PaymentRecurringCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentRecurringCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentRecurringCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentRecurringCreatedEvent $event)
    {
        $paymentRecurring = $event->paymentRecurring;
        $eventOptions = $event->options;
    }
}
