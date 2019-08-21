<?php


namespace App\Repositories\Contracts;


interface ResidentArchiveRepository extends BaseRepository
{
    /**
     * archive a resident by resident
     *
     * @param \ArrayAccess $resident
     * @return \ArrayAccess
     */
    public function saveByResident(\ArrayAccess $resident): \ArrayAccess;


    /**
     * save multiple residents in archive from resident data
     *
     * @param array $data
     * @return mixed
     */
    public function saveMultipleResidents(array $data);
}
