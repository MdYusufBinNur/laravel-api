<?php

namespace App\Events\Equipment;

use App\DbModels\Equipment;
use Illuminate\Queue\SerializesModels;

class EquipmentUpdatedEvent
{
    use SerializesModels;

    /**
     * @var Equipment
     */
    public $equipment;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Equipment $equipment
     * @param array $options
     */
    public function __construct(Equipment $equipment, array $options = [])
    {
        $this->equipment = $equipment;
        $this->options = $options;
    }
}
