<?php

namespace App\Listeners\PaymentRecur;

use App\Events\PaymentRecur\PaymentRecurCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentRecurCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentRecurCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentRecurCreatedEvent $event)
    {
        $paymentRecur = $event->paymentRecur;
        $eventOptions = $event->options;
    }
}
