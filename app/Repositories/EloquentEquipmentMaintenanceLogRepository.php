<?php


namespace App\Repositories;


use App\Repositories\Contracts\EquipmentMaintenanceLogRepository;

class EloquentEquipmentMaintenanceLogRepository extends EloquentBaseRepository implements EquipmentMaintenanceLogRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['eq.equipment' => 'equipment'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

}
