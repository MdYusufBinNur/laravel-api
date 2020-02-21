<?php


namespace App\DbModels\Traits\Users;


use App\DbModels\Role;

trait CommonUserMethods
{
    /**
     * has up to the Role
     *
     * @param int $propertyId
     * @param int $upToRoleId
     * @return bool
     */
    public function upToTheRoleInAProperty(int $upToRoleId, int $propertyId)
    {
        $roles = $this->userRoles;

        foreach ($roles as $role) {
            if ($role->propertyId == $propertyId && $role->roleId <= $upToRoleId) {
                return true;
            }
        }

        return false;
    }

    /**
     * has any role upto priority staff
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToPriorityStaffOfTheProperty($propertyId)
    {
        return $this->upToTheRoleInAProperty(Role::ROLE_STAFF_PRIORITY['id'], $propertyId);
    }

    /**
     * has role upto standard staff
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToStandardStaffOfTheProperty($propertyId)
    {
        return $this->upToTheRoleInAProperty(Role::ROLE_STAFF_STANDARD['id'], $propertyId);
    }

    /**
     * has any role upto limited staff
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToLimitedStaffOfTheProperty($propertyId)
    {
        return $this->upToTheRoleInAProperty(Role::ROLE_STAFF_LIMITED['id'], $propertyId);
    }
}
