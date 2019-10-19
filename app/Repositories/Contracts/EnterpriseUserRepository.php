<?php


namespace App\Repositories\Contracts;


interface EnterpriseUserRepository extends BaseRepository
{
    /**
     * update a updateEnterpriseUser
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function updateEnterpriseUser(\ArrayAccess $model, array $data): \ArrayAccess;

    /**
     * get enterprise user' ids by searching name from user table
     *
     * @param array $searchCriteria
     * @return array
     */
    public function getEnterpriseUserIdsByName(array $searchCriteria = []);
}
