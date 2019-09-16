<?php

namespace App\Listeners\Package;

use App\DbModels\Resident;
use App\Events\Package\PackageCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use App\Mail\Package\PackageArrived;
use App\Repositories\Contracts\PackageRepository;
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
            Mail::to($resident->user->email)->send(new PackageArrived($package));
        } else {
            foreach ($package->unit->residents as $resident) {
                Mail::to($resident->user->email)->send(new PackageArrived($package));
            }
        }

        $packageRepository = app(PackageRepository::class);
        $packageRepository->update($package, ['notifiedByEmail' => 1]);
    }
}
