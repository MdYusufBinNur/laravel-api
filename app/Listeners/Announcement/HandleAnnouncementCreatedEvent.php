<?php

namespace App\Listeners\Announcement;

use App\DbModels\UserNotificationType;
use App\Events\Announcement\AnnouncementCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleAnnouncementCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  AnnouncementCreatedEvent  $event
     * @return void
     */
    public function handle(AnnouncementCreatedEvent $event)
    {
        $announcement = $event->announcement;
        $eventOptions = $event->options;

        $toUserIds = $announcement->property->users()->pluck('userId')->toArray();

        $userNotificationRepository = app(UserNotificationRepository::class);
        foreach ($toUserIds as $toUserId) {
            $message = 'An announcement from your property';
            $userNotificationRepository->save([
                'fromUserId' => $announcement->createdByUserId,
                'toUserId' => $toUserId,
                'userNotificationTypeId' => UserNotificationType::ANNOUNCEMENT['id'],
                'resourceId' => $announcement->id,
                'message' => $message,
            ]);
        }
    }
}
