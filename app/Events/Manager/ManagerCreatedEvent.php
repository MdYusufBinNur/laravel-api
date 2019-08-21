<?php

namespace App\Events\Manager;

use App\DbModels\Manager;
use Illuminate\Queue\SerializesModels;

class ManagerCreatedEvent
{
    use SerializesModels;

    /**
     * @var Manager
     */
    public $manager;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Manager $manager
     * @param array $options
     * @return void
     */
    public function __construct(Manager $manager, array $options = [])
    {
        $this->manager = $manager;
        $this->options = $options;
    }
}
