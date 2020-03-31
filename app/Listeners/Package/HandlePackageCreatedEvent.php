<?php

namespace App\Listeners\Package;

use App\DbModels\Resident;
use App\DbModels\UserNotificationType;
use App\Events\Package\PackageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Package\PackageArrived;
use App\Repositories\Contracts\PackageRepository;
use App\Repositories\Contracts\UserNotificationRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePackageCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param PackageCreatedEvent $event
     * @return void
     */
    public function handle(PackageCreatedEvent $event)
    {
        $package = $event->package;
        $eventOptions = $event->options;
        $resident = $package->resident;

        if ($resident instanceof Resident) {
            $this->savePackageAddedNotification($package->createdByUserId, $resident->user->id, $package->id);
            Mail::to($resident->user->email)->send(new PackageArrived($package));
        } else {
            foreach ($package->unit->residents as $resident) {
                $this->savePackageAddedNotification($package->createdByUserId, $resident->user->id, $package->id);
                Mail::to($resident->user->email)->send(new PackageArrived($package));
            }
        }

        $packageRepository = app(PackageRepository::class);
        $packageRepository->update($package, ['notifiedByEmail' => 1]);
    }


    /**
     * save package added notification
     *
     * @param int $fromUserId
     * @param int $toUserId
     * @param int $resourceId
     */
    private function savePackageAddedNotification($fromUserId, $toUserId, $resourceId)
    {
        // save notification
        $userNotificationRepository = app(UserNotificationRepository::class);
        $userNotificationRepository->save([
            'fromUserId' => $fromUserId,
            'toUserId' => $toUserId,
            'userNotificationTypeId' => UserNotificationType::PACKAGE['id'],
            'resourceId' => $resourceId,
            'message' => "You have a new Package.",
        ]);
    }
}
