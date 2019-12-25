<?php


namespace App\Repositories\Contracts;


use App\DbModels\PasswordReset;
use App\DbModels\User;

interface PasswordResetRepository extends BaseRepository
{
    /**
     * reset a user's password
     *
     * @param array $data
     * @param PasswordReset $passwordReset
     * @return User
     */
    public function resetPassword(PasswordReset $passwordReset, array $data);

}
