<?php


namespace App\DbModels\Traits\UserRoles;


trait StaffRoleMethods
{
    /**
     * is a priority staff user
     *
     * @return boolean
     */
    public function isPriorityStaffUserRole()
    {
        return $this->role->isPriorityStaffRole();
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
     * does the priority staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesPriorityStaffHaveAccessToTheProperty(int $propertyId)
    {
        return $this->isPriorityStaffUserRole()
            && $this->hasThePropertyAssigned($propertyId);
    }

    /**
     * does the standard staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesStandardStaffHaveAccessToTheProperty(int $propertyId)
    {
        return $this->isStandardStaffUserRole()
            && $this->hasThePropertyAssigned($propertyId);
    }

    /**
     * does the limited staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesLimitedStaffHaveAccessToTheProperty(int $propertyId)
    {
        return $this->isLimitedStaffUserRole()
            && $this->hasThePropertyAssigned($propertyId);
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
