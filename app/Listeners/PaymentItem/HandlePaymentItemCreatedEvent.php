<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\PaymentItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePaymentItemCreatedEvent implements ShouldQueue
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
     * @param  PaymentItemCreatedEvent  $event
     * @return void
     */
    public function handle(PaymentItemCreatedEvent $event)
    {
        $paymentItem = $event->paymentItem;
        $eventOptions = $event->options;


        $logData = [
            'paymentItemId' => $paymentItem->id,
            'propertyId' => $paymentItem->propertyId,
            'status' => $paymentItem->status,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'event' => 'created'
        ];
        $logData['status'] = $paymentItem->status;
        $logData['updatedByUserId'] = $eventOptions['request']['loggedInUserId'];
        $this->paymentItemLogRepository->save($logData);
    }
}
