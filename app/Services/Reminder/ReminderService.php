<?php


namespace App\Services\Reminder;


use App\DbModels\PaymentItem;
use App\DbModels\Reminder;
use App\DbModels\UserNotificationType;
use App\Mail\Payment\SendPaymentItemReminder;
use App\Mail\ResidentAccessRequest\ResendResidentAccessRequestPin;
use App\Repositories\Contracts\PaymentItemLogRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Services\Helpers\SmsHelper;
use Illuminate\Support\Facades\Mail;

class ReminderService
{
    /**
     * base constructor
     *
     * @param Reminder $reminder
     * @param $eventOptions
     */
    public static function sendReminderByResourceType(Reminder $reminder, $eventOptions)
    {
        switch ($reminder->resourceType) {
            case Reminder::RESOURCE_TYPE_PAYMENT_ITEM:
                (new ReminderService)->sendReminderOfPaymentItem($reminder, $eventOptions);
                break;
            case Reminder::RESOURCE_TYPE_RESIDENT_ACCESS_REQUEST:
                (new ReminderService)->sendReminderOfResidentAccessRequestPin($reminder, $eventOptions);
                break;
        }
    }

    // TODO need to add sending SMS to user feature

    /**
     * send pin to user about resident access request
     * @param Reminder $reminder
     * @param $eventOptions
     */
    private function sendReminderOfResidentAccessRequestPin(Reminder $reminder, $eventOptions){
        $createdByUserId = $eventOptions['request']['loggedInUserId'];
        $residentAccessRequest = $reminder->detailByType;

        if (!empty($residentAccessRequest->email && $reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL)){
            Mail::to($residentAccessRequest->email)->send(new ResendResidentAccessRequestPin($residentAccessRequest));
        }
        if (!empty($residentAccessRequest->phone && $reminder->reminderType == Reminder::REMINDER_TYPE_SMS)){
            SmsHelper::sendRegistrationPin($residentAccessRequest);
        }
    }

    /**
     * send reminder mail to user about payment item
     * @param Reminder $reminder
     * @param $eventOptions
     */
    private function sendReminderOfPaymentItem(Reminder $reminder, $eventOptions){
        $createdByUserId = $eventOptions['request']['loggedInUserId'];
        $paymentItem = $reminder->detailByType;
        if (!empty($paymentItem->unitId)) {
            $residents = $paymentItem->unit->residents;
            foreach ($residents as $resident) {
                $user = $resident->user;
                $this->savePaymentNotification($createdByUserId, $user->id, $reminder->id);
                if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL){
                    Mail::to($resident->contactEmail)->send(new SendPaymentItemReminder($reminder, $user, $paymentItem));
                }
                if ($reminder->reminderType == Reminder::REMINDER_TYPE_SMS){
                    SmsHelper::sendPaymentItemNotification($paymentItem, $user->phone);
                }
            }
        } else {
            $user = $paymentItem->user;
            $this->savePaymentNotification($createdByUserId, $user->id, $reminder->id);
            if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL) {
                Mail::to($user->email)->send(new SendPaymentItemReminder($reminder, $user, $paymentItem));
            }

            if ($reminder->reminderType == Reminder::REMINDER_TYPE_SMS){
                SmsHelper::sendPaymentItemNotification($paymentItem, $user->phone);
            }
        }
        $this->logPaymentItem($paymentItem, $eventOptions);
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
            'userNotificationTypeId' => UserNotificationType::REMINDER['id'],
            'resourceId' => $resourceId,
            'message' => "You have a new reminder.",
        ]);
    }

    /**
     * log reminder event in payment
     *
     * @param PaymentItem $paymentItem
     * @param $eventOptions
     */
    private function logPaymentItem($paymentItem, $eventOptions)
    {
        $paymentItemLogRepository = app(PaymentItemLogRepository::class);

        //log the event
        $logData = [
            'paymentItemId' => $paymentItem->id,
            'propertyId' => $paymentItem->propertyId,
            'updatedByUserId' => $eventOptions['request']['loggedInUserId'],
            'event' => 'reminder'
        ];
        $paymentItemLogRepository->save($logData);
    }
}
