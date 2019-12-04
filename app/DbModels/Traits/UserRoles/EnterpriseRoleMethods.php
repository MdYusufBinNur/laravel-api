<?php


namespace App\DbModels\Traits\UserRoles;


trait EnterpriseRoleMethods
{
    /**
     * is a enterprise's admin user role
     *
     * @return boolean
     */
    public function isAdminEnterpriseUserRole()
    {
        return $this->role->isAdminEnterpriseRole();
    }

    /**
     * is a enterprise's standard user
     *
     * @return boolean
     */
    public function isStandardEnterpriseUserRole()
    {
        return $this->role->isStandardEnterpriseRole();
    }

    /**
     * has any enterprise user role
     *
     * @return boolean
     */
    public function hasEnterpriseUserRole()
    {
        return $this->role->hasEnterpriseRole();
    }
}
