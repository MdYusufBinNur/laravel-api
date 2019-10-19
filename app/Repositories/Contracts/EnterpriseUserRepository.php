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
     * delete enterprise user
     *
     * @param \ArrayAccess $enterpriseUser
     * @param array $data
     * @return bool
     */
    public function deleteEnterpriseUser(\ArrayAccess $enterpriseUser, array $data = []): bool;
}
