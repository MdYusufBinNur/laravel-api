<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'name', 'email', 'phone', 'password', 'locale', 'createdByUserId', 'isActive', 'lastLoginAt'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $castsROle = [
        'lastLoginAt' => 'datetime:Y-m-d h:i',
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
     * user and managers relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managers()
    {
        return $this->hasMany(Manager::class, 'userId', 'id');
    }

    /**
     * user and enterprise user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enterpriseUser()
    {
        return $this->hasOne(EnterpriseUser::class, 'userId');
    }

    /**
     * user and admin user relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->hasOne(Admin::class, 'userId');
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
     * is a owner type resident
     *
     * @return bool
     */
    public function isOwnerResident()
    {
        foreach ($this->userRoles as $userRoles) {
            if ($userRoles->isOwnerResidentUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a tenant type resident
     *
     * @return bool
     */
    public function isTenantResident()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->isTenantResidentUserRole()) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a any kind of resident user
     *
     * @return bool
     */
    public function isResident()
    {
        foreach ($this->userRoles as $userRole) {
            if ($userRole->hasResidentUserRole()) {
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

    /**
     * get user's profile picture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userProfilePics()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_USER_PROFILE);
    }

    /**
     * get user's profile profile info
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'userId', 'id');
    }

    /**
     * resident of a specific property query builder
     *
     * @param int $propertyId
     * @return HasMany
     */
    public function scopeResidentOfTheProperty($propertyId)
    {
        return $this->residents()->where('propertyId', $propertyId);
    }

    /**
     * is the user is a resident of a specific property
     *
     * @param int $propertyId
     * @return true
     */
    public function isResidentOfTheProperty($propertyId)
    {
        return $this->scopeResidentOfTheProperty($propertyId)->first() instanceof Resident;
    }

    /**
     * is the user in a specific property
     *
     * @param int $propertyId
     * @return true
     */
    public function userOfTheProperty($propertyId)
    {
        return $this->isAdmin()
            || $this->isAnEnterpriseUserOfTheProperty($propertyId)
            || $this->isAStaffOfTheProperty($propertyId)
            || $this->userRoles()->where('propertyId', $propertyId)->first() instanceof UserRole;
    }

    public function getPropertyIds()
    {
        $propertyIds = [];
        foreach ($this->userRoles as $userRole) {
            if (isset($userRole->propertyId)) {
                $propertyIds[] = $userRole->propertyId;
            }
        }

        return array_unique($propertyIds);
    }

    public function getCompanyId()
    {
        $enterPriseUser = $this->enterpriseUser;

        return $enterPriseUser instanceof EnterpriseUser ? $enterPriseUser->companyId : null;
    }


    public function getRolesTitles()
    {
        $roles = [];
        foreach ($this->userRoles as $userRole) {
            $roles[] = $userRole->role->title;
        }
        return $roles;
    }
}
