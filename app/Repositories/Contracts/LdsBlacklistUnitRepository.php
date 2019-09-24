<?php


namespace App\Repositories\Contracts;


interface LdsBlacklistUnitRepository extends BaseRepository
{
    /**
     * save black list unit
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function saveBlackListUnit(array $data): \ArrayAccess;

}
