<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentItemCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemCreatedEvent $event)
    {
        $paymentItem = $event->paymentItem;
        $eventOptions = $event->options;
    }
}
