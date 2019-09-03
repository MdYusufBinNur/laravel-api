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
}
