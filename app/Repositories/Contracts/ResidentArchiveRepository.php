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
}
