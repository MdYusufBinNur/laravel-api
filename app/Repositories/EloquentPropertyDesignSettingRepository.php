<?php


namespace App\Repositories;


use App\Repositories\Contracts\PropertyDesignSettingRepository;

class EloquentPropertyDesignSettingRepository extends EloquentBaseRepository implements PropertyDesignSettingRepository
{
    /**
     * @inheritDoc
     */
    public function setDesignSetting(array $data): \ArrayAccess
    {
       return $this->patch(['propertyId' => $data['propertyId']], $data);
    }

}
