<?php


namespace App\DbModels\Traits;


trait StaffRoleMethods
{
    /**
     * is a priority staff user
     *
     * @return boolean
     */
    public function isPriorityStaffUserRole()
    {
        return $this->role->isSuperStaffRole();
    }

    /**
     * is a standard staff user
     *
     * @return boolean
     */
    public function isStandardStaffUserRole()
    {
        return $this->role->isStandardStaffRole();
    }

    /**
     * is a limited staff user
     *
     * @return boolean
     */
    public function isLimitedStaffUserRole()
    {
        return $this->role->isLimitedStaffRole();
    }

    /**
     * has any staff user role
     *
     * @return boolean
     */
    public function hasStaffUserRole()
    {
        return $this->role->hasStaffRole();
    }

    /**
     * does the staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesStaffHaveAccessToTheProperty(int $propertyId)
    {
        return $this->hasStaffUserRole()
            && $this->hasThePropertyAssigned($propertyId);
    }

}
