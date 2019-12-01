<?php

namespace App\Listeners\LdsSetting;

use App\Events\LdsSetting\LdsSettingCreatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleLdsSettingCreatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  LdsSettingCreatedEvent  $event
     * @return void
     */
    public function handle(LdsSettingCreatedEvent $event)
    {
        $ldsSetting = $event->ldsSetting;
        $eventOptions = $event->options;
    }
}
