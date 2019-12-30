<?php

namespace App\Listeners\PaymentPublishLog;

use App\Events\PaymentPublishLog\PaymentPublishLogCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentPublishLogCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PaymentPublishLogCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentPublishLogCreatedEvent $event)
    {
        $paymentPublishLog = $event->paymentPublishLog;
        $eventOptions = $event->options;
    }
}
