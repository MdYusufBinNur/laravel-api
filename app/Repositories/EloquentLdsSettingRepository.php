<?php


namespace App\Repositories;


use App\DbModels\Unit;
use App\Repositories\Contracts\LdsSettingRepository;

class EloquentLdsSettingRepository extends EloquentBaseRepository implements LdsSettingRepository
{
    /**
     * @inheritDoc
     */
    public function saveLdsSetting(array $data): \ArrayAccess
    {
        $unitRepository = app(Unit::class);
        $unit = $unitRepository->findOne($data['unitId']);
        $data['propertyId'] = $unit->propertyId;
        return $this->patch(['propertyId' => $data['propertyId']], $data);
    }

    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['ldss.property' => 'property'];
        return parent::findBy($searchCriteria, $withTrashed);
    }
}
