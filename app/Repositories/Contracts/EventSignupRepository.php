<?php


namespace App\Repositories\Contracts;


interface EventSignupRepository extends BaseRepository
{
    /**
     * save event signup
     *
     * @param array $data
     * @return \ArrayAccess
     */
    public function saveEventSignup(array $data): \ArrayAccess;

}
