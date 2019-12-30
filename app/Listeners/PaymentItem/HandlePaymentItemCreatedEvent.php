<?php

namespace App\Listeners\PaymentItem;

use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\SendInvoice;
use App\Repositories\Contracts\PaymentItemLogRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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

        // log the event
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

        // send email
        if (!empty($paymentItem->unitId)) {
            $residents = $paymentItem->unit->residents;
            foreach ($residents as $resident) {
                Mail::to($resident->contactEmail)->send(new SendInvoice($paymentItem, $resident->user->name));
            }
        } else {
            $user = $paymentItem->user;
            Mail::to($user->email)->send(new SendInvoice($paymentItem, $user->name));
        }
    }
}
