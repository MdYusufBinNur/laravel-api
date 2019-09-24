<?php


namespace App\Repositories\Contracts;


interface LdsSettingRepository extends BaseRepository
{
    /**
     * save lds setting
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function saveLdsSetting(array $data): \ArrayAccess;
}
