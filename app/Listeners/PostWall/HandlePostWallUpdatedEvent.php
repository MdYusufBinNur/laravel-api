<?php

namespace App\Listeners\PostWall;

use App\Events\PostWall\PostWallUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostWallUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostWallUpdatedEvent  $event
     * @return void
     */
    public function handle(PostWallUpdatedEvent $event)
    {
        $postWall = $event->postWall;
        $eventOptions = $event->options;
        $oldPostWall = $eventOptions['oldModel'];
    }
}
