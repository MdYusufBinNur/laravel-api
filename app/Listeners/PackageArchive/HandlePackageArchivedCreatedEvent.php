<?php

namespace App\Listeners\PackageArchive;

use App\DbModels\Resident;
use App\Events\Package\PackageCreatedEvent;
use App\Events\PackageArchive\PackageArchivedCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\PackageArchive\PackageSignOut;
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
            Mail::to($resident->user->email)->send(new PackageSignOut($packageArchive));
        } else {
            foreach ($package->unit->residents as $resident) {
                Mail::to($resident->user->email)->send(new PackageSignOut($packageArchive));
            }
        }
    }
}
