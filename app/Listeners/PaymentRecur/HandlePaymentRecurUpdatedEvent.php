<?php

namespace App\Listeners\PaymentRecur;

use App\Events\PaymentRecur\PaymentRecurUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentRecurUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentRecurUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentRecurUpdatedEvent $event)
    {
        $paymentRecur = $event->paymentRecur;
        $eventOptions = $event->options;
        $oldPaymentRecur = $eventOptions['oldModel'];
    }
}
