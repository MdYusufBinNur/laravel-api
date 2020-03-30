<?php

namespace App\Listeners\PackageArchive;

use App\DbModels\Resident;
use App\DbModels\UserNotificationType;
use App\Events\Package\PackageCreatedEvent;
use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\PackageArchive\PackageSignOut;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePackageArchivedCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PackageCreatedEvent $event
     * @return void
     */
    public function handle(PackageArchivedCreatedEvent $event)
    {
        $packageArchive = $event->packageArchive;
        $eventOptions = $event->options;
        $package = $packageArchive->package;
        $resident = $package->resident;

        if ($resident instanceof Resident) {
            $this->savePackageSignoutNotification($packageArchive->createdByUserId, $packageArchive->signOutUserId, $packageArchive->id);
            Mail::to($resident->user->email)->send(new PackageSignOut($packageArchive));
        } else {
            foreach ($package->unit->residents as $resident) {
                $this->savePackageSignoutNotification($packageArchive->createdByUserId, $packageArchive->signOutUserId, $packageArchive->id);
                Mail::to($resident->user->email)->send(new PackageSignOut($packageArchive));
            }
        }
    }

    /**
     * save package added notification
     *
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $resourceId
     */
    private function savePackageSignoutNotification($fromUserId, $toUserId, $resourceId)
    {
        // save notification
        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'fromUserId' => $fromUserId,
            'toUserId' => $toUserId,
            'userNotificationTypeId' => UserNotificationType::PACKAGE_SIGNOUT['id'],
            'resourceId' => $resourceId,
            'message' => "Your Package has been delivered",
        ]);
    }
}
