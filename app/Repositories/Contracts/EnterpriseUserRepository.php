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
<<<<<<< HEAD
     * get enterprise user' ids by searching name from user table
     *
     * @param array $searchCriteria
     * @return array
     */
    public function getEnterpriseUserIdsByName(array $searchCriteria = []);
=======
     * delete enterprise user
     *
     * @param \ArrayAccess $enterpriseUser
     * @param array $data
     * @return bool
     */
    public function deleteEnterpriseUser(\ArrayAccess $enterpriseUser, array $data = []): bool;
>>>>>>> 2cd7cdf27bd6324aaac9362b834f999c703862f2
}
