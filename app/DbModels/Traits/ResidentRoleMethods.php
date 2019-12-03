<?php


namespace App\DbModels\Traits;


trait ResidentRoleMethods
{
    /**
     * is a owner type resident's user role
     *
     * @return boolean
     */
    public function isOwnerResidentUserRole()
    {
        return $this->role->isOwnerResidentRole();
    }

    /**
     * is a tenant type resident's user role
     *
     * @return boolean
     */
    public function isTenantResidentUserRole()
    {
        return $this->role->isTenantResidentRole();
    }


    /**
     * has any resident user role
     *
     * @return boolean
     */
    public function hasResidentUserRole()
    {
        return $this->role->hasResidentRole();
    }
}
