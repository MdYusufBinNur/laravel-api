<?php

namespace App\DbModels;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'locale', 'createdByUserId', 'isActive', 'lastLoginAt'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param $pass
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * user and roles relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId', 'id');
    }

    /**
     * user and residents relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class, 'userId', 'id');
    }

    /**
     * is a active user
     *
     * @return bool
     */
    public function isActive()
    {
        return (boolean)$this->isActive;
    }

    /**
     * is a super admin user
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isSuperAdminUserRole()) {
                return true;
            }
        }

        return false;
    }

    /**
     * is a standard admin user
     *
     * @return bool
     */
    public function isStandardAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isStandardAdminUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a limited admin user
     *
     * @return bool
     */
    public function isLimitedAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isLimitedAdminUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of admin user
     *
     * @return bool
     */
    public function isAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasAdminUserRole()) {
                return true;
            }
        }
        return false;
    }


    /**
     * is a priority staff user
     *
     * @return bool
     */
    public function isPriorityStaff()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isPririorityStaffUserRole()) {
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
     * is a resident user
     *
     * @return bool
     */
    public function isResident()
    {
        return $this->residents()->count() > 0;
    }

    /**
     * is a tenant type resident
     *
     * @return bool
     */
    public function isTenantTypeResident()
    {
        foreach ($this->residents as $resident) {
            if ($resident->isTypeTenant()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a owner type resident
     *
     * @return bool
     */
    public function isOwnerTypeResident()
    {
        foreach ($this->residents as $resident) {
            if ($resident->isTypeOwner()) {
                return true;
            }
        }
        return false;
    }

    /**
     * has the resident access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function hasResidentAccessToTheProperty(int $propertyId)
    {
        if ($this->isResident()) {
            foreach ($this->residents as $resident) {
                if ($resident->hasAccessToTheProperty($propertyId)) {
                    return true;
                }
            }
        }

        return false;
    }
}
