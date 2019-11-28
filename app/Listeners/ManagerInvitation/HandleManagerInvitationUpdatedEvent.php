<?php

namespace App\Listeners\ManagerInvitation;

use App\Events\ManagerInvitation\ManagerInvitationUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleManagerInvitationUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ManagerInvitationUpdatedEvent  $event
     * @return void
     */
    public function handle(ManagerInvitationUpdatedEvent $event)
    {
        $managerInvitation = $event->managerInvitation;
        $eventOptions = $event->options;
        $oldManagerInvitation = $eventOptions['oldModel'];
    }
}
