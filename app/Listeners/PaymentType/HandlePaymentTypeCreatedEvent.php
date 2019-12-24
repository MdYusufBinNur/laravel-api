<?php

namespace App\Listeners\PaymentType;

use App\Events\PaymentType\PaymentTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentTypeCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentTypeCreatedEvent $event)
    {
        $paymentType = $event->paymentType;
        $eventOptions = $event->options;
    }
}
