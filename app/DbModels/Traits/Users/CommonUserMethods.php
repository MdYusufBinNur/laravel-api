<?php


namespace App\DbModels\Traits\Users;


trait CommonUserMethods
{
    /**
     * has any role upto standard admin user
     *
     * @return bool
     */
    public function upToStandardAdmin()
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isStandardAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto limited admin user
     *
     * @return bool
     */
    public function uptoLimitedAdmin()
    {
        if ($this->upToStandardAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto admin enterprise user
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToAdminEnterpriseUserOfTheProperty($propertyId)
    {
        if ($this->uptoLimitedAdmin($propertyId)) {
            return true;
        }

        if ($this->isAnAdminEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto standard enterprise user
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToStandardEnterpriseUserOfTheProperty($propertyId)
    {
        if ($this->upToAdminEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isAStandardEnterpriseUserOfTheProperty($propertyId)) {
            return true;
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
        if ($this->upToStandardEnterpriseUserOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isAPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * has role upto standard staff
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToStandardStaffOfTheProperty($propertyId)
    {
        if ($this->upToPriorityStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isAStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto limited staff
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToLimitedStaffOfTheProperty($propertyId)
    {
        if ($this->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isALimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }

    /**
     * has any role upto resident user
     *
     * @param int $propertyId
     * @return bool
     */
    public function upToResidentOfTheProperty($propertyId)
    {
        if ($this->upToLimitedStaffOfTheProperty($propertyId)) {
            return true;
        }

        if ($this->isResidentOfTheProperty($propertyId)) {
            return true;
        }

        return false;
    }
}
