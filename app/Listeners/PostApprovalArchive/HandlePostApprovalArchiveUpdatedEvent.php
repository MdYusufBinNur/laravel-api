<?php

namespace App\Listeners\PostApprovalArchive;

use App\Events\PostApprovalArchive\PostApprovalArchiveUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostApprovalArchiveUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostApprovalArchiveUpdatedEvent  $event
     * @return void
     */
    public function handle(PostApprovalArchiveUpdatedEvent $event)
    {
        $postApprovalArchive = $event->postApprovalArchive;
        $eventOptions = $event->options;
        $oldPostApprovalArchive = $eventOptions['oldModel'];
    }
}
