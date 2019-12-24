<?php

namespace App\Listeners\PaymentRecurring;

use App\Events\PaymentRecurring\PaymentRecurringUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentRecurringUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentRecurringUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentRecurringUpdatedEvent $event)
    {
        $paymentRecurring = $event->paymentRecurring;
        $eventOptions = $event->options;
        $oldPaymentRecur = $eventOptions['oldModel'];
    }
}
