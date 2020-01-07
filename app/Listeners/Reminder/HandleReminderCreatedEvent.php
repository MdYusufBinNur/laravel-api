<?php

namespace App\Listeners\Reminder;

use App\DbModels\Reminder;
use App\DbModels\UserNotificationType;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\SendInvoice;
use App\Mail\Reminder\SendReminder;
use App\Repositories\Contracts\ReminderRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleReminderCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * @var ReminderRepository
     */
    private $reminderRepository;

    /**
     * HandlePaymentItemUpdatedEvent constructor.
     * @param ReminderRepository $reminderRepository
     */
    public function __construct(ReminderRepository $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }

    /**
     * Handle the event.
     *
     * @param  ReminderCreatedEvent  $event
     * @return void
     */
    public function handle(ReminderCreatedEvent $event)
    {
        $reminder = $event->reminder;
        $eventOptions = $event->options;
        $details = $reminder->detailByType;

        // send email and save notification
        if (!empty($details->unitId)) {
            $residents = $details->unit->residents;
            foreach ($residents as $resident) {
                $user = $resident->user;
                $this->savePaymentNotification($reminder->createdByUserId, $user->id, $reminder->id);
                if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL){
                    Mail::to($resident->contactEmail)->send(new SendReminder($reminder, $user, $$details));
                }
            }
        } else {
            $user = $details->user;
            $this->savePaymentNotification($reminder->createdByUserId, $user->id, $reminder->id);
            if ($reminder->reminderType == Reminder::REMINDER_TYPE_EMAIL) {
                Mail::to($user->email)->send(new SendReminder($reminder, $user, $details));
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
