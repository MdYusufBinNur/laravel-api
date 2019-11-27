<?php

namespace App\Events\ManagerInvitation;

use App\DbModels\ManagerInvitation;
use Illuminate\Queue\SerializesModels;

class ManagerInvitationCreatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ManagerInvitation
     */
    public $managerInvitation;

    /**
     * Create a new event instance.
     *
     * @param ManagerInvitation $managerInvitation
     * @param array $options
     */
    public function __construct(ManagerInvitation $managerInvitation, array $options = [])
    {
        $this->managerInvitation = $managerInvitation;
        $this->options = $options;
    }
}
