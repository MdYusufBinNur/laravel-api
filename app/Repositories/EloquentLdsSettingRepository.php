<?php


namespace App\Repositories;


use App\Repositories\Contracts\LdsSettingRepository;

class EloquentLdsSettingRepository extends EloquentBaseRepository implements LdsSettingRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
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
