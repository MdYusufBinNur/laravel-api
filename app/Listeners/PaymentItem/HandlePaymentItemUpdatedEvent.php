<?php

namespace App\Listeners\PaymentItem;

use App\DbModels\Payment;
use App\DbModels\PaymentItem;
use App\DbModels\UserNotificationType;
use App\Events\PaymentItem\PaymentItemUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\PaymentItemUpdated;
use App\Repositories\Contracts\PaymentItemLogRepository;
use App\Repositories\Contracts\PaymentRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePaymentItemUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var PaymentRepository
     */
    private $paymentRepository;

    /**
     * @var PaymentItemLogRepository
     */
    private $paymentItemLogRepository;

    /**
     * HandlePaymentItemUpdatedEvent constructor.
     * @param PaymentRepository $paymentRepository,
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

            // set payment's status
            $payment = $paymentItem->payment;
            if ($paymentItem->status == PaymentItem::STATUS_PAID) {
                $this->paymentRepository->updatePayment($payment, ['status' => Payment::STATUS_PARTIALLY_DONE]);
            }

            //log event
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
                    $user = $resident->user;
                    $this->savePaymentNotification($payment->toUserId, $user->id, $paymentItem->id);
                    Mail::to($resident->contactEmail)->send(new PaymentItemUpdated($paymentItem, $user->name));
                }
            } else {
                $user = $paymentItem->user;
                $this->savePaymentNotification($payment->toUserId, $user->id, $paymentItem->id);
                Mail::to($user->email)->send(new PaymentItemUpdated($paymentItem, $user->name));
            }
        }
    }

    /**
     * save payment item's notification
     *
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $resourceId
     */
    private function savePaymentNotification($fromUserId, $toUserId, $resourceId)
    {
        // save notification
        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'fromUserId' => $fromUserId,
            'toUserId' => $toUserId,
            'userNotificationTypeId' => UserNotificationType::PAYMENT_ITEM_CREATED['id'],
            'resourceId' => $resourceId,
            'message' => "One of your payment status has been updated.",
        ]);
    }
}
