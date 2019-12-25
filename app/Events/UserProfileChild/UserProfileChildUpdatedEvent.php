<?php

namespace App\Events\UserProfileChild;

use App\DbModels\UserProfileChild;
use Illuminate\Queue\SerializesModels;

class UserProfileChildUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserProfileChild
     */
    public $userProfileChild;

    /**
     * Create a new event instance.
     *
     * @param UserProfileChild $userProfileChild
     * @param array $options
     */
    public function __construct(UserProfileChild $userProfileChild, array $options = [])
    {
        $this->userProfileChild = $userProfileChild;
        $this->options = $options;
    }
}
