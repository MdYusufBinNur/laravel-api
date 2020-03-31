<?php

namespace App\Listeners\Announcement;

use App\DbModels\UserNotificationType;
use App\Events\Announcement\AnnouncementCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Announcement\AnnouncementCreated;
use App\Repositories\Contracts\UserNotificationRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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

        $toUsers = $announcement->property->users;

        $userNotificationRepository = app(UserNotificationRepository::class);
        foreach ($toUsers as $user) {
            $message = 'An Announcement From' . $announcement->property->title;

            $userNotificationRepository->save([
                'fromUserId' => $announcement->createdByUserId,
                'toUserId' => $user->id,
                'userNotificationTypeId' => UserNotificationType::ANNOUNCEMENT['id'],
                'resourceId' => $announcement->id,
                'message' => $message,
            ]);

            Mail::to($user->email)->send(new AnnouncementCreated($announcement, $user));
        }
    }
}
