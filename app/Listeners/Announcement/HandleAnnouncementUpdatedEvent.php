<?php

namespace App\Listeners\Announcement;

use App\Events\Announcement\AnnouncementUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleAnnouncementUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  AnnouncementUpdatedEvent  $event
     * @return void
     */
    public function handle(AnnouncementUpdatedEvent $event)
    {
        $announcement = $event->announcement;
        $eventOptions = $event->options;
        $oldAnnouncement = $eventOptions['oldModel'];
    }
}
