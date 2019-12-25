<?php

namespace App\Listeners\PostMarketPlace;

use App\Events\PostMarketPlace\PostMarketPlaceCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostMarketPlaceCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostMarketPlaceCreatedEvent  $event
     * @return void
     */
    public function handle(PostMarketPlaceCreatedEvent $event)
    {
        $postMarketplace = $event->postMarketplace;
        $eventOptions = $event->options;
    }
}
