<?php


namespace App\DbModels\Traits\Users;


use App\DbModels\Company;
use App\DbModels\EnterpriseUser;
use Illuminate\Support\Arr;

trait EnterpriseUserMethods
{
    /**
     * is a standard staff user
     *
     * @return bool
     */
    public function isAdminEnterpriseUser()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isAdminEnterpriseUserRole()) {
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
    public function isStandardEnterpriseUser()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStandardEnterpriseUserRole()) {
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
    public function isEnterpriseUser()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasEnterpriseUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a enterprise user of the company
     *
     * @param int $companyId
     * @return bool
     */
    public function isAnAdminEnterpriseUserOfTheCompany(int $companyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesEnterpriseUserRoleHaveAdminAccessToTheCompany($companyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * is an enterprise user of the company
     *
     * @param int $propertyId
     * @return bool
     */
    public function isAnEnterpriseUserOfTheProperty(int $propertyId)
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->doesEnterpriseUserRoleHaveAccessToTheProperty($propertyId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * get the company of a enterprise user
     *
     * @return mixed|null
     */
    public function getCompany()
    {
        $enterPriseUser = $this->enterpriseUser;
        return $enterPriseUser instanceof EnterpriseUser ? $enterPriseUser->company : null;
    }

    /**
     * get property ids of the enterprise users
     *
     * @param int $propertyId
     * @return array
     */
    public function getEnterpriseUserPropertyIds()
    {
        $propertyIds = [];
        if ($this->isAdminEnterpriseUser()) {
            $company = $this->getCompany();
            if ($company instanceof Company) {
                $propertyIds[] = $company->properties()->pluck('id')->toArray();
            }
        }

        if ($this->isStandardEnterpriseUser()) {
            $propertyIds[] = $this->enterpriseUser->enterPriseUserProperties->pluck('propertyId')->toArray();
        }

        return Arr::flatten(array_unique($propertyIds));
    }
}
