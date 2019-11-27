<?php

namespace App\Listeners\EnterpriseUserProperty;

use App\Events\EnterpriseUserProperty\EnterpriseUserPropertyCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEnterpriseUserPropertyCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EnterpriseUserPropertyCreatedEvent  $event
     * @return void
     */
    public function handle(EnterpriseUserPropertyCreatedEvent $event)
    {
        $enterpriseUserProperty = $event->enterpriseUserProperty;
        $eventOptions = $event->options;
    }
}
