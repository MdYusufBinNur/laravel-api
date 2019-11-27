<?php

namespace App\Events\UserPropertyResident;

use App\DbModels\UserPropertyResident;
use Illuminate\Queue\SerializesModels;

class UserPropertyResidentUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserPropertyResident
     */
    public $userPropertyResident;

    /**
     * Create a new event instance.
     *
     * @param UserPropertyResident $userPropertyResident
     * @param array $options
     */
    public function __construct(UserPropertyResident $userPropertyResident, array $options = [])
    {
        $this->userPropertyResident = $userPropertyResident;
        $this->options = $options;
    }
}
