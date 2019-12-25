<?php

namespace App\Events\ServiceRequestOfficeDetail;

use App\DbModels\ServiceRequestOfficeDetail;
use Illuminate\Queue\SerializesModels;

class ServiceRequestOfficeDetailCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ServiceRequestOfficeDetail
     */
    public $serviceRequestOfficeDetail;

    /**
     * Create a new event instance.
     *
     * @param ServiceRequestOfficeDetail $serviceRequestOfficeDetail
     * @param array $options
     */
    public function __construct(ServiceRequestOfficeDetail $serviceRequestOfficeDetail, array $options = [])
    {
        $this->serviceRequestOfficeDetail = $serviceRequestOfficeDetail;
        $this->options = $options;
    }
}
