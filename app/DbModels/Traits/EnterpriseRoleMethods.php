<?php


namespace App\DbModels\Traits;


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

    /**
     * does the enterprise user-role have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesEnterpriseUserRoleHaveAccessToTheProperty(int $propertyId)
    {
        if ($this->isAdminEnterpriseUserRole()) {
            return true;
        }

        if ($this->hasEnterpriseUserRole()) {
            foreach ($this->enterpriseUsers as $enterpriseUser) {
                return in_array($propertyId, $enterpriseUser->enterPriseUserProperties->pluck('propertyId')->toArray());
            }
        }

        return false;
    }

    /**
     * does the staff have access to the company
     *
     * @param int $companyId
     * @return bool
     */
    public function doesEnterpriseUserRoleHaveAdminAccessToTheCompany(int $companyId)
    {
        if ($this->isAdminEnterpriseUserRole()) {
            foreach ($this->enterpriseUsers as $enterpriseUser) {
                return $enterpriseUser->companyId == $companyId;
            }
        }

        return false;
    }

}
