<?php

namespace App\Listeners\PostApprovalBlacklistUnit;

use App\Events\PostApprovalBlacklistUnit\PostApprovalBlacklistUnitUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostApprovalBlacklistUnitUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostApprovalBlacklistUnitUpdatedEvent  $event
     * @return void
     */
    public function handle(PostApprovalBlacklistUnitUpdatedEvent $event)
    {
        $postApprovalBlacklistUnit = $event->postApprovalBlacklistUnit;
        $eventOptions = $event->options;
        $oldPostApprovalBlacklistUnit = $eventOptions['oldModel'];
    }
}
