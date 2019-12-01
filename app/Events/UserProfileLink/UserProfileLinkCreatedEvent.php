<?php

namespace App\Events\UserProfileLink;

use App\DbModels\UserProfileLink;
use Illuminate\Queue\SerializesModels;

class UserProfileLinkCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var UserProfileLink
     */
    public $userProfileLink;

    /**
     * Create a new event instance.
     *
     * @param UserProfileLink $userProfileLink
     * @param array $options
     */
    public function __construct(UserProfileLink $userProfileLink, array $options = [])
    {
        $this->userProfileLink = $userProfileLink;
        $this->options = $options;
    }
}
