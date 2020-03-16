<?php

namespace App\Listeners\PaymentItemPartial;

use App\Events\PaymentItemPartial\PaymentItemPartialUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemPartialUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PaymentItemPartialUpdatedEvent $event
     * @return void
     */
    public function handle(PaymentItemPartialUpdatedEvent $event)
    {
        $paymentItemPartial = $event->paymentItemPartial;
        $eventOptions = $event->options;
        $oldPaymentItemPartial = $eventOptions['oldModel'];
    }
}
