<?php

namespace App\Listeners\ManagerInvitation;

use App\Events\ManagerInvitation\ManagerInvitationCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleManagerInvitationCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  ManagerInvitationCreatedEvent  $event
     * @return void
     */
    public function handle(ManagerInvitationCreatedEvent $event)
    {
        $managerInvitation = $event->managerInvitation;
        $eventOptions = $event->options;
    }
}
