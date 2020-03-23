<?php

namespace App\Listeners\Payment;

use App\Events\Payment\PaymentCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var PaymentItemRepository
     */
    private $paymentItemRepository;

    /**
     * HandlePaymentCreatedEvent constructor.
     * @param PaymentRepository $paymentRepository
     * @param PaymentItemRepository $paymentItemRepository
     */
    public function __construct(PaymentRepository $paymentRepository, PaymentItemRepository $paymentItemRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->paymentItemRepository = $paymentItemRepository;
    }

    /**
     * Handle the event.
     *
     * @param  PaymentCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentCreatedEvent $event)
    {
        $payment = $event->payment;
        $eventOptions = $event->options;
        $this->paymentItemRepository->publishPayment($payment);

    }
}
