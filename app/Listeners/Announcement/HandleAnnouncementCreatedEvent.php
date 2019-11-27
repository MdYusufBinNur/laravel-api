<?php

namespace App\Listeners\Announcement;

use App\Events\Announcement\AnnouncementCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleAnnouncementCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  AnnouncementCreatedEvent  $event
     * @return void
     */
    public function handle(AnnouncementCreatedEvent $event)
    {
        $announcement = $event->announcement;
        $eventOptions = $event->options;
    }
}
