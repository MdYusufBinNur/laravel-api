<?php

namespace App\Listeners\PostApprovalArchive;

use App\Events\PostApprovalArchive\PostApprovalArchiveCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostApprovalArchiveCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostApprovalArchiveCreatedEvent  $event
     * @return void
     */
    public function handle(PostApprovalArchiveCreatedEvent $event)
    {
        $postApprovalArchive = $event->postApprovalArchive;
        $eventOptions = $event->options;
    }
}
