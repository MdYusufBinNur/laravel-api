<?php

namespace App\Listeners\Payment;

use App\Events\Payment\PaymentUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemRepository;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentUpdatedEvent implements ShouldQueue
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
     * @param  PaymentUpdatedEvent  $event
     * @return void
     */
    public function handle(PaymentUpdatedEvent $event)
    {
        $payment = $event->payment;
        $eventOptions = $event->options;
        $oldPayment = $eventOptions['oldModel'];

        $changedData = $this->getChangedData($payment, $oldPayment);

        if (isset($changedData['toUserIds']) || isset($changedData['toUnitIds'])) {
            $this->paymentItemRepository->publishPayment($payment);
        }

    }
}
