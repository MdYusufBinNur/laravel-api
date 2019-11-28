<?php

namespace App\Listeners\EnterpriseUserProperty;

use App\Events\EnterpriseUserProperty\EnterpriseUserPropertyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleEnterpriseUserPropertyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  EnterpriseUserPropertyUpdatedEvent  $event
     * @return void
     */
    public function handle(EnterpriseUserPropertyUpdatedEvent $event)
    {
        $enterpriseUserProperty = $event->enterpriseUserProperty;
        $eventOptions = $event->options;
        $oldEnterpriseUserProperty = $eventOptions['oldModel'];
    }
}
