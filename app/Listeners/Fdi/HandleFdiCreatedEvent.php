<?php

namespace App\Listeners\Fdi;

use App\DbModels\FdiLog;
use App\DbModels\UserNotificationType;
use App\Events\Fdi\FdiCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Fdi\AuthorizedGuestRequestToStaffCreated;
use App\Repositories\Contracts\FdiLogRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandleFdiCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param FdiCreatedEvent $event
     * @return void
     */
    public function handle(FdiCreatedEvent $event)
    {
        $fdi = $event->fdi;
        $eventOptions = $event->options;

        $fdiLogRepository = app(FdiLogRepository::class);

        $fdiLogRepository->save([
            'fdiId' => $fdi->id,
            'userId' => $fdi->createdByUserId,
            'type' => FdiLog::TYPE_ADD,
            'text' => 'Added'
        ]);


        $toStaffUsers = $fdi->property->staffUsers;
        /* sending mail to staff of the property */
        foreach ($toStaffUsers as $staffUser) {
            Mail::to($staffUser->email)->send(new AuthorizedGuestRequestToStaffCreated($staffUser,$fdi));
            $this->saveFdiNotification($fdi->createdByUserId, $staffUser->id, $fdi->id);
        }
    }


    /**
     * save authorized guest request notification
     *
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $resourceId
     */
    private function saveFdiNotification($fromUserId, $toUserId, $resourceId)
    {
        // save notification
        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'fromUserId' => $fromUserId,
            'toUserId' => $toUserId,
            'userNotificationTypeId' => UserNotificationType::FDI['id'],
            'resourceId' => $resourceId,
            'message' => "Authorized Guest Request",
        ]);
    }




}
