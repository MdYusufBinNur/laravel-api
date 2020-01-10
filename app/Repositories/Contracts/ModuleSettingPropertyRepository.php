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
     * is module active for the property
     *
     * @param int $propertyId
     * @param int $moduleId
     * @return mixed
     */
    public function isModuleActiveForTheProperty(int $propertyId, int $moduleId);

    /**
     * set module property
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setModuleSettingProperty(array $data): \ArrayAccess;

}
