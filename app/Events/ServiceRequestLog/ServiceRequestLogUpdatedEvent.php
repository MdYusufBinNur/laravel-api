<?php

namespace App\Events\ServiceRequestLog;

use App\DbModels\ServiceRequestLog;
use Illuminate\Queue\SerializesModels;

class ServiceRequestLogUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ServiceRequestLog
     */
    public $serviceRequestLog;

    /**
     * Create a new event instance.
     *
     * @param ServiceRequestLog $serviceRequestLog
     * @param array $options
     */
    public function __construct(ServiceRequestLog $serviceRequestLog, array $options = [])
    {
        $this->serviceRequestLog = $serviceRequestLog;
        $this->options = $options;
    }
}
