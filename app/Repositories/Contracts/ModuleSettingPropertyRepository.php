<?php


namespace App\Repositories\Contracts;


interface ModuleSettingPropertyRepository extends BaseRepository
{
    /**
     * get active modules' ids by propertyId
     *
     * @param int $propertyId
     * @return array
     */
    public function getActiveModuleIdsByPropertyId(int $propertyId);

    /**
     * set module property
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setModuleSettingProperty(array $data): \ArrayAccess;

}
