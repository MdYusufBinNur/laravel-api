<?php


namespace App\Repositories\Contracts;


interface ModuleOptionPropertyRepository extends BaseRepository
{
    /**
     * save one or multiple module-option-property
     *
     * @param array $data
     * @return mixed
     */
    public function saveModuleOptionProperty(array $data);

    /**
     * get a module option value of a property
     *
     * @param int $propertyId
     * @param array $moduleOptionConst
     * @return mixed
     */
    public function getAModuleOptionValueByProperty(int $propertyId, array $moduleOptionConst);
}
