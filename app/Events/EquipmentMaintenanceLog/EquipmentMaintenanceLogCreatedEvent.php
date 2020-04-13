<?php

namespace App\Events\EquipmentMaintenanceLog;

use App\DbModels\EquipmentMaintenanceLog;
use Illuminate\Queue\SerializesModels;

class EquipmentMaintenanceLogCreatedEvent
{
    use SerializesModels;

    /**
     * @var EquipmentMaintenanceLog
     */
    public $equipmentMaintenanceLog;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param EquipmentMaintenanceLog $equipmentMaintenanceLog
     * @param array $options
     */
    public function __construct(EquipmentMaintenanceLog $equipmentMaintenanceLog, array $options = [])
    {
        $this->equipmentMaintenanceLog = $equipmentMaintenanceLog;
        $this->options = $options;
    }
}
