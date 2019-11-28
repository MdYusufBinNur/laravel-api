<?php

namespace App\Events\ResidentVehicle;

use App\DbModels\ResidentVehicle;
use Illuminate\Queue\SerializesModels;

class ResidentVehicleUpdatedEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $options;

    /**
     * @var ResidentVehicle
     */
    public $residentVehicle;

    /**
     * Create a new event instance.
     *
     * @param ResidentVehicle $residentVehicle
     * @param array $options
     */
    public function __construct(ResidentVehicle $residentVehicle, array $options = [])
    {
        $this->residentVehicle = $residentVehicle;
        $this->options = $options;
    }
}
