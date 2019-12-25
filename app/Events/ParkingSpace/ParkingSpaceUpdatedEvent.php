<?php

namespace App\Events\ParkingSpace;

use App\DbModels\ParkingSpace;
use Illuminate\Queue\SerializesModels;

class ParkingSpaceUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ParkingSpace
     */
    public $parkingSpace;

    /**
     * Create a new event instance.
     *
     * @param ParkingSpace $parkingSpace
     * @param array $options
     */
    public function __construct(ParkingSpace $parkingSpace, array $options = [])
    {
        $this->parkingSpace = $parkingSpace;
        $this->options = $options;
    }
}
