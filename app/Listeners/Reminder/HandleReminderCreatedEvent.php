<?php

namespace App\Listeners\Reminder;

use App\DbModels\Reminder;
use App\Events\Reminder\ReminderCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Payment\SendInvoice;
use App\Repositories\Contracts\ReminderRepository;
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
                if ($reminder->email == Reminder::REMINDER_TYPE_EMAIL){
                    Mail::to($resident->contactEmail)->send(new SendInvoice($paymentItem, $user->name));
                }
            }
        } else {
            $user = $details->user;
            dd($user);
            $this->savePaymentNotification($payment->createdByUserId, $user->id, $paymentItem->id);
            Mail::to($user->email)->send(new SendInvoice($paymentItem, $user->name));
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
            'message' => "You have a new payment notification.",
        ]);
    }
}
