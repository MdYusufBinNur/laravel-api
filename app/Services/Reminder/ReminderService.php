<?php


namespace App\Services\Reminder;


use App\DbModels\Reminder;
use App\DbModels\UserNotificationType;
use App\Mail\Payment\SendPaymentItemReminder;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Support\Facades\Mail;

class ReminderService
{
    /**
     * base constructor
     * 
     * @param Reminder $reminder
     */
    public static function sendReminderByResourceType(Reminder $reminder)
    {
        switch ($reminder->resourceType) {
            case Reminder::RESOURCE_TYPE_PAYMENT_ITEM:
                (new ReminderService)->sendReminderOfPaymentItem($reminder);
                break;
        }
    }

    // TODO need to add sending SMS to user feature
    /**
     * send reminder mail to user about payment item
     * @param Reminder $reminder
     */
    private function sendReminderOfPaymentItem(Reminder $reminder){
        $details = $reminder->detailByType;
        if (!empty($details->unitId)) {
            $residents = $details->unit->residents;
            foreach ($residents as $resident) {
                $user = $resident->user;
                $this->savePaymentNotification($reminder->createdByUserId, $user->id, $reminder->id);
                if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL){
                    Mail::to($resident->contactEmail)->send(new SendPaymentItemReminder($reminder, $user, $$details));
                }
            }
        } else {
            $user = $details->user;
            $this->savePaymentNotification($reminder->createdByUserId, $user->id, $reminder->id);
            if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL) {
                Mail::to($user->email)->send(new SendPaymentItemReminder($reminder, $user, $details));
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
            'userNotificationTypeId' => UserNotificationType::REMINDER['id'],
            'resourceId' => $resourceId,
            'message' => "You have a new reminder.",
        ]);
    }
}
