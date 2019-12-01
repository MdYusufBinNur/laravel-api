<?php


namespace App\Repositories\Contracts;


interface ModuleSettingPropertyRepository extends BaseRepository
{
    /**
     * set module property
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setModuleSettingProperty(array $data): \ArrayAccess;


}
