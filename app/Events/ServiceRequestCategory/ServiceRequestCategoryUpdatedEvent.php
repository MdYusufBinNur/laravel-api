<?php

namespace App\Events\ServiceRequestCategory;

use App\DbModels\ServiceRequestCategory;
use Illuminate\Queue\SerializesModels;

class ServiceRequestCategoryUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ServiceRequestCategory
     */
    public $serviceRequestCategory;

    /**
     * Create a new event instance.
     *
     * @param ServiceRequestCategory $serviceRequestCategory
     * @param array $options
     */
    public function __construct(ServiceRequestCategory $serviceRequestCategory, array $options = [])
    {
        $this->serviceRequestCategory = $serviceRequestCategory;
        $this->options = $options;
    }
}
