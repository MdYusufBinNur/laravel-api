<?php

namespace App\Events\EnterpriseUserProperty;

use App\DbModels\EnterpriseUserProperty;
use Illuminate\Queue\SerializesModels;

class EnterpriseUserPropertyCreatedEvent
{
    use SerializesModels;

    /**
     * @var EnterpriseUserProperty
     */
    public $enterpriseUserProperty;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param EnterpriseUserProperty $enterpriseUserProperty
     * @param array $options
     */
    public function __construct(EnterpriseUserProperty $enterpriseUserProperty, array $options = [])
    {
        $this->enterpriseUserProperty = $enterpriseUserProperty;
        $this->options = $options;
    }
}
