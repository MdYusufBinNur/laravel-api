<?php

namespace App\Listeners\Company;

use App\Events\Company\CompanyUpdatedEvent;
use App\Listeners\CommonListenerFeatures;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleCompanyUpdatedEvent implements ShouldQueue
{
    use CommonListenerFeatures;

    /**
     * Handle the event.
     *
     * @param  CompanyUpdatedEvent  $event
     * @return void
     */
    public function handle(CompanyUpdatedEvent $event)
    {
        $company = $event->company;
        $eventOptions = $event->options;
        $oldCompany = $eventOptions['oldModel'];
    }
}
