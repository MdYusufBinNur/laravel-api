<?php

namespace App\Listeners\Package;

use App\Events\Package\PackageUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePackageUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param $event $event
     * @return void
     */
    public function handle(PackageUpdatedEvent $event)
    {
        $package = $event->package;
        $eventOptions = $event->options;
        $oldPackage = $eventOptions['oldModel'];


        //todo

    }
}
