<?php

namespace App\Listeners\PackageType;

use App\Events\PackageType\PackageTypeUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePackageTypeUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PackageTypeUpdatedEvent  $event
     * @return void
     */
    public function handle(PackageTypeUpdatedEvent $event)
    {
        $packageType = $event->packageType;
        $eventOptions = $event->options;
        $oldPackageType = $eventOptions['oldModel'];
    }
}
