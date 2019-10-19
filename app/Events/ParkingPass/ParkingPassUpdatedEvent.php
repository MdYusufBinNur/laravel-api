<?php

namespace App\Events\ParkingPass;

use App\DbModels\ParkingPass;
use Illuminate\Queue\SerializesModels;

class ParkingPassUpdatedEvent
{
    use SerializesModels;

    /**
     * @var ParkingPass
     */
    public $parkingPass;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param ParkingPass $parkingPass
     * @param array $options
     * @return void
     */
    public function __construct(ParkingPass $parkingPass, array $options = [])
    {
        $this->parkingPass = $parkingPass;
        $this->options = $options;
    }
}
