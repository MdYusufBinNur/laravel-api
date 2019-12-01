<?php

namespace App\Events\ParkingPassLog;

use App\DbModels\ParkingPassLog;
use Illuminate\Queue\SerializesModels;

class ParkingPassLogUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ParkingPassLog
     */
    public $parkingPassLog;

    /**
     * Create a new event instance.
     *
     * @param ParkingPassLog $parkingPassLog
     * @param array $options
     */
    public function __construct(ParkingPassLog $parkingPassLog, array $options = [])
    {
        $this->parkingPassLog = $parkingPassLog;
        $this->options = $options;
    }
}
