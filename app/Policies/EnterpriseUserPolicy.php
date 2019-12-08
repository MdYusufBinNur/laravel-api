<?php

namespace App\Policies;

use App\DbModels\EnterpriseUser;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EnterpriseUserPolicy
{
    use HandlesAuthorization;

    /**
     * Intercept checks
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $companyId
     * @return bool
     */
    public function list(User $currentUser, int $companyId)
    {
        if ($currentUser->isAnEnterpriseUserOfTheCompany($companyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $companyId
     * @return bool
     */
    public function store(User $currentUser, int $companyId)
    {
        if ($currentUser->isAnAdminEnterpriseUserOfTheCompany($companyId)) {
            return true;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param EnterpriseUser $enterpriseUser
     * @return bool
     */
    public function show(User $currentUser,  EnterpriseUser $enterpriseUser)
    {
        $propertyIds = $enterpriseUser->enterPriseUserProperties()->pluck('propertyId')->toArray();

        foreach ($propertyIds as $propertyId) {
            if ($currentUser->isUserOfTheProperty($propertyId)) {
                return true;
            }
        }

        return $currentUser->id === $enterpriseUser->userId;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param EnterpriseUser $enterpriseUser
     * @return bool
     */
    public function update(User $currentUser, EnterpriseUser $enterpriseUser)
    {
        if ($currentUser->isAnAdminEnterpriseUserOfTheCompany($enterpriseUser->companyId)) {
            return true;
        }

        return $currentUser->id === $enterpriseUser->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param EnterpriseUser $enterpriseUser
     * @return bool
     */
    public function destroy(User $currentUser, EnterpriseUser $enterpriseUser)
    {
        if ($currentUser->isAnAdminEnterpriseUserOfTheCompany($enterpriseUser->companyId)) {
            return true;
        }

        return false;
    }
}
