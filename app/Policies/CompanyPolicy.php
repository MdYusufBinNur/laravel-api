<?php

namespace App\Policies;

use App\DbModels\Company;
use App\DbModels\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
        if ($currentUser->isSuperAdmin() || $currentUser->isStandardAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @return bool
     */
    public function list(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function store(User $currentUser)
    {
        return false;
    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param Company $company
     * @return bool
     */
    public function show(User $currentUser,  Company $company)
    {
        return $currentUser->isLimitedAdmin() || $currentUser->isAnEnterpriseUserOfTheCompany($company->id);
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param Company $company
     * @return bool
     */
    public function update(User $currentUser, Company $company)
    {
        return $currentUser->isAnAdminEnterpriseUserOfTheCompany($company->id);
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param Company $company
     * @return bool
     */
    public function destroy(User $currentUser, Company $company)
    {
        return false;
    }
}
