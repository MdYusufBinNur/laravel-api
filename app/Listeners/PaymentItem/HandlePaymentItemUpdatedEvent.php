<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\PaymentItemUpdated;
use App\Mail\Payment\SendInvoice;
use App\Repositories\Contracts\PaymentItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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

            // send email
            if (!empty($paymentItem->unitId)) {
                $residents = $paymentItem->unit->residents;
                foreach ($residents as $resident) {
                    Mail::to($resident->contactEmail)->send(new PaymentItemUpdated($paymentItem, $resident->user->name));
                }
            } else {
                $user = $paymentItem->user;
                Mail::to($user->email)->send(new PaymentItemUpdated($paymentItem, $user->name));
            }
        }


    }
}
