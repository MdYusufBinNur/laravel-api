<?php

namespace App\Listeners\Visitor;

use App\DbModels\User;
use App\DbModels\UserNotificationType;
use App\Events\Visitor\VisitorCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Visitor\VisitorArrived;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Services\Helpers\SmsHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleVisitorCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  VisitorCreatedEvent  $event
     * @return void
     */
    public function handle(VisitorCreatedEvent $event)
    {
        $visitor = $event->visitor;
        $eventOptions = $event->options;

        $user = $visitor->user;

        if ($user instanceof User) {
            $this->saveVisitorEntryNotification($visitor->createdByUserId, $user->id, $visitor->id);
            Mail::to($user->email)->send(new VisitorArrived($visitor));
            SmsHelper::sendVisitorNotification($visitor, $user->phone);
        } else {
            foreach ($visitor->unit->residents as $resident) {
                $this->saveVisitorEntryNotification($visitor->createdByUserId, $resident->user->id, $visitor->id);
                $user = $resident->user;
                Mail::to($user->email)->send(new VisitorArrived($visitor));

                SmsHelper::sendVisitorNotification($visitor, $user->phone);
            }
        }

    }

    /**
     * save visitor entry notification
     *
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $resourceId
     */
    private function saveVisitorEntryNotification($fromUserId, $toUserId, $resourceId)
    {
        // save notification
        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'fromUserId' => $fromUserId,
            'toUserId' => $toUserId,
            'userNotificationTypeId' => UserNotificationType::VISITOR['id'],
            'resourceId' => $resourceId,
            'message' => "Some one have arrived to you",
        ]);
    }
}
