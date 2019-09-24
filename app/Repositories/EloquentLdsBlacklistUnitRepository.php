<?php


namespace App\Repositories;


use App\Repositories\Contracts\LdsBlacklistUnitRepository;

class EloquentLdsBlacklistUnitRepository extends EloquentBaseRepository implements LdsBlacklistUnitRepository
{
    /**
     * @inheritDoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $searchCriteria['eagerLoad'] = ['lbu.property' => 'property', 'lbu.unit' => 'unit', 'unit.property' => 'unit.property', 'unit.tower' => 'unit.tower'];
        return parent::findBy($searchCriteria, $withTrashed);
    }

    /**
     * @inheritDoc
     */
    public function saveBlackListUnit(array $data): \ArrayAccess
    {
        return parent::patch($data, $data);
    }
}
