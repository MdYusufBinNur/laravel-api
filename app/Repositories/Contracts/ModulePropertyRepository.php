<?php


namespace App\Repositories\Contracts;


interface ModulePropertyRepository extends BaseRepository
{
    /**
     * set module property
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setModuleProperty(array $data): \ArrayAccess;

}
