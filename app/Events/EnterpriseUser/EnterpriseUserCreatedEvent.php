<?php

namespace App\Events\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use Illuminate\Queue\SerializesModels;

class EnterpriseUserCreatedEvent
{
    use SerializesModels;

    /**
     * @var EnterpriseUser
     */
    public $enterpriseUser;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param EnterpriseUser $enterpriseUser
     * @param array $options
     * @return void
     */
    public function __construct(EnterpriseUser $enterpriseUser, array $options = [])
    {
        $this->enterpriseUser = $enterpriseUser;
        $this->options = $options;
    }
}
