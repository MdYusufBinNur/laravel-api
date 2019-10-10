<?php

namespace App\Repositories\Contracts;

interface UserRepository extends BaseRepository
{
    /**
     * update a user
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function updateUser(\ArrayAccess $model, array $data): \ArrayAccess;

    /**
     * find staffs
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findStaffs(array $searchCriteria = []);

    /**
     * get user lists auto-complete
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function usersListAutoComplete(array $searchCriteria = []);
}
