<?php

namespace App\Events\ServiceRequest;

use App\DbModels\ServiceRequest;
use Illuminate\Queue\SerializesModels;

class ServiceRequestUpdatedEvent
{
    use SerializesModels;

    /**
     * @var ServiceRequest
     */
    public $serviceRequest;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ServiceRequest $serviceRequest
     * @param array $options
     * @return void
     */
    public function __construct(ServiceRequest $serviceRequest, array $options = [])
    {
        $this->serviceRequest = $serviceRequest;
        $this->options = $options;
    }
}
