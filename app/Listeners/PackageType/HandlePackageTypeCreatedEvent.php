<?php

namespace App\Listeners\PackageType;

use App\Events\PackageType\PackageTypeCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePackageTypeCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PackageTypeCreatedEvent  $event
     * @return void
     */
    public function handle(PackageTypeCreatedEvent $event)
    {
        $packageType = $event->packageType;
        $eventOptions = $event->options;
    }
}
