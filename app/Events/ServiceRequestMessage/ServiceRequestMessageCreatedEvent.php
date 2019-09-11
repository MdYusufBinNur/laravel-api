<?php

namespace App\Events\ServiceRequestMessage;

use App\DbModels\ServiceRequestMessage;
use Illuminate\Queue\SerializesModels;

class ServiceRequestMessageCreatedEvent
{
    use SerializesModels;

    /**
     * @var ServiceRequestMessage
     */
    public $serviceRequestMessage;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ServiceRequestMessage $serviceRequestMessage
     * @param array $options
     * @return void
     */
    public function __construct(ServiceRequestMessage $serviceRequestMessage, array $options = [])
    {
        $this->serviceRequestMessage = $serviceRequestMessage;
        $this->options = $options;
    }
}
