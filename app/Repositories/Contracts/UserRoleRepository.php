<?php


namespace App\Repositories\Contracts;


interface UserRoleRepository extends BaseRepository
{
    /**
     * get user ids of the property
     *
     * @param int $propertyId
     * @return mixed
     */
    public function getUserIdsOfEntireProperty(int $propertyId);

}
