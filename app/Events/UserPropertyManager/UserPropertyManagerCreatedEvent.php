<?php

namespace App\Events\UserPropertyManager;

use App\DbModels\UserPropertyManager;
use Illuminate\Queue\SerializesModels;

class UserPropertyManagerCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserPropertyManager
     */
    public $userPropertyManager;

    /**
     * Create a new event instance.
     *
     * @param UserPropertyManager $userPropertyManager
     * @param array $options
     */
    public function __construct(UserPropertyManager $userPropertyManager, array $options = [])
    {
        $this->userPropertyManager = $userPropertyManager;
        $this->options = $options;
    }
}
