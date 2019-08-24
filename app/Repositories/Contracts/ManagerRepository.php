<?php


namespace App\Repositories\Contracts;


interface ManagerRepository extends BaseRepository
{
    /**
     * find all staff users
     *
     * @param array $searchCriteria
     * @return mixed
     */
    public function findStaffUsers(array $searchCriteria);


    /**
     * delete a staff user
     *
     * @param \ArrayAccess $staff
     * @param array $data
     * @return bool
     */
    public function deleteStaff(\ArrayAccess $staff, array $data = []): bool;

}