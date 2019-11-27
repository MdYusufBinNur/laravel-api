<?php

namespace App\Listeners\PostApprovalBlacklistUnit;

use App\Events\PostApprovalBlacklistUnit\PostApprovalBlacklistUnitCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePostApprovalBlacklistUnitCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  PostApprovalBlacklistUnitCreatedEvent  $event
     * @return void
     */
    public function handle(PostApprovalBlacklistUnitCreatedEvent $event)
    {
        $postApprovalBlacklistUnit = $event->postApprovalBlacklistUnit;
        $eventOptions = $event->options;
    }
}
