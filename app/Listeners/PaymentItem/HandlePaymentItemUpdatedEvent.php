<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentItemLogRepository
     */
    private $paymentItemLogRepository;

    /**
     * HandlePaymentItemUpdatedEvent constructor.
     * @param PaymentItemLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Handle the event.
     *
     * @param PaymentItemUpdatedEvent $event
     * @return void
     */
    public function handle(PaymentItemUpdatedEvent $event)
    {
        $paymentItem = $event->paymentItem;
        $eventOptions = $event->options;
        $oldPaymentItem = $eventOptions['oldModel'];

        // if `status` changes
        if ($this->hasAFieldValueChanged($paymentItem, $oldPaymentItem, 'status')) {

            $logData = [
                'paymentItemId' => $paymentItem->id,
                'propertyId' => $paymentItem->propertyId,
                'status' => $paymentItem->status,
                'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
                'event' => 'updated'
            ];

            $this->paymentItemLogRepository->save($logData);
        }


    }
}
