<?php

namespace App\Listeners\PostMarketPlace;

use App\Events\PostMarketPlace\PostMarketPlaceUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostMarketPlaceUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostMarketPlaceUpdatedEvent  $event
     * @return void
     */
    public function handle(PostMarketPlaceUpdatedEvent $event)
    {
        $postMarketplace = $event->postMarketplace;
        $eventOptions = $event->options;
        $oldPostMarketplace = $eventOptions['oldModel'];
    }
}
