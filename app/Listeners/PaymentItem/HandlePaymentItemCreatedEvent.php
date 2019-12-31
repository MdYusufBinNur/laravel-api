<?php

namespace App\Listeners\PaymentItem;

use App\DbModels\Payment;
use App\Events\PaymentItem\PaymentItemCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\SendInvoice;
use App\Repositories\Contracts\PaymentItemLogRepository;
use App\Repositories\Contracts\PaymentRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePaymentItemCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentItemLogRepository
     */
    private $paymentRepository;

    /**
     * @var PaymentItemLogRepository
     */
    private $paymentItemLogRepository;

    /**
     * HandlePaymentItemUpdatedEvent constructor.
     * @param PaymentRepository $paymentRepository
     * @param PaymentItemLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentRepository $paymentRepository, PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentRepository = $paymentRepository;
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
        $payment = $paymentItem->payment;

        // set payment's status
        if ($payment->status == Payment::STATUS_NOT_PUBLISHED) {
            $this->paymentRepository->updatePayment($payment, ['status' => Payment::STATUS_PENDING]);
        }

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
