<?php

namespace App\Listeners\LdsSetting;

use App\Events\LdsSetting\LdsSettingUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSettingUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSettingUpdatedEvent  $event
     * @return void
     */
    public function handle(LdsSettingUpdatedEvent $event)
    {
        $ldsSetting = $event->ldsSetting;
        $eventOptions = $event->options;
        $oldLdsSetting = $eventOptions['oldModel'];
    }
}
