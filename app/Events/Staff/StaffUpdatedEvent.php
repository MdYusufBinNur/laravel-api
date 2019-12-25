<?php

namespace App\Events\Staff;

use App\DbModels\Manager;
use Illuminate\Queue\SerializesModels;

class StaffUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var Manager
     */
    public $manager;

    /**
     * Create a new event instance.
     *
     * @param Manager $manager
     * @param array $options
     */
    public function __construct(Manager $manager, array $options = [])
    {
        $this->manager = $manager;
        $this->options = $options;
    }
}
