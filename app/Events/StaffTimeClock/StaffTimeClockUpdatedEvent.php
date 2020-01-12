<?php

namespace App\Events\StaffTimeClock;

use App\DbModels\StaffTimeClock;
use Illuminate\Queue\SerializesModels;

class StaffTimeClockUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var StaffTimeClock
     */
    public $staffTimeClock;

    /**
     * Create a new event instance.
     *
     * @param StaffTimeClock $staffTimeClock
     * @param array $options
     */
    public function __construct(StaffTimeClock $staffTimeClock, array $options = [])
    {
        $this->staffTimeClock = $staffTimeClock;
        $this->options = $options;
    }
}
