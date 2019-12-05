<?php


namespace App\DbModels\Traits\Users;


use Illuminate\Database\Eloquent\Relations\HasMany;

trait StaffUserMethods
{
    /**
     * is a priority staff user
     *
     * @return bool
     */
    public function isPriorityStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isPriorityStaffUserRole()) {
                return true;
            }
        }

        return false;
    }

    /**
     * is a standard staff user
     *
     * @return bool
     */
    public function isStandardStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStandardStaffUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a limited staff user
     *
     * @return bool
     */
    public function isLimitedStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isLimitedStaffUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of staff user
     *
     * @return bool
     */
    public function isStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasStaffUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a priority staff of the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function isAPriorityStaffOfTheProperty(int $propertyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesPriorityStaffHaveAccessToTheProperty($propertyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a priority staff of the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function isAStandardStaffOfTheProperty(int $propertyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesStandardStaffHaveAccessToTheProperty($propertyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a priority staff of the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function isALimitedStaffOfTheProperty(int $propertyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesLimitedStaffHaveAccessToTheProperty($propertyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a staff of the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function isAStaffOfTheProperty(int $propertyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesStaffHaveAccessToTheProperty($propertyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * resident of a specific property query builder
     *
     * @param int $propertyId
     * @return HasMany
     */
    public function scopeStaffOfTheProperty($propertyId)
    {
        return $this->managers()->where('propertyId', $propertyId);
    }
}
