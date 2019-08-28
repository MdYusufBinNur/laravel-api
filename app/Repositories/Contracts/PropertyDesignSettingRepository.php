<?php


namespace App\Repositories\Contracts;


interface PropertyDesignSettingRepository extends BaseRepository
{
    /**
     * set design setting
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function setDesignSetting(array $data): \ArrayAccess;

}
