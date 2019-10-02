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
}
