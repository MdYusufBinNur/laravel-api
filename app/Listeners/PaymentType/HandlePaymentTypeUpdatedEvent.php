<?php

namespace App\Listeners\PaymentType;

use App\Events\PaymentType\PaymentTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.a
     *
     * @param  PaymentTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentTypeUpdatedEvent $event)
    {
        $paymentType = $event->paymentType;
        $eventOptions = $event->options;
        $oldPaymentType = $eventOptions['oldModel'];
    }
}
