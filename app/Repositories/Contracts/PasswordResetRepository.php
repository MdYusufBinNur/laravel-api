<?php


namespace App\Repositories\Contracts;


interface PasswordResetRepository extends BaseRepository
{
    /**
     * reset a user's password
     *
     * @param array $data
     * @return bool|null
     */
    public function resetPassword(array $data);

}
