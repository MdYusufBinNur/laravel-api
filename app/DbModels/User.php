<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use App\DbModels\Traits\Users\CommonUserMethods;
use App\DbModels\Traits\Users\EnterpriseUserMethods;
use App\DbModels\Traits\Users\AdminUserMethods;
use App\DbModels\Traits\Users\ResidentUserMethods;
use App\DbModels\Traits\Users\StaffUserMethods;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, CommonModelFeatures;

    use AdminUserMethods, EnterpriseUserMethods, StaffUserMethods, ResidentUserMethods, CommonUserMethods;

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
     * set default values
     *
     * @var array
     */
    protected $attributes = [
        'isActive' => 1
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
     * @return HasMany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId', 'id');
    }

    /**
     * user and residents relationship
     *
     * @return HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class, 'userId', 'id');
    }

    /**
     * user and managers relationship
     *
     * @return HasMany
     */
    public function managers()
    {
        return $this->hasMany(Manager::class, 'userId', 'id');
    }

    /**
     * user and staffs relationship (alias of managers)
     *
     * @return HasMany
     */
    public function staffs()
    {
        return $this->managers();
    }

    /**
     * user and enterprise user relationship
     *
     * @return HasOne
     */
    public function enterpriseUser()
    {
        return $this->hasOne(EnterpriseUser::class, 'userId');
    }

    /**
     * user and admin user relationship
     *
     * @return HasOne
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
        return (boolean) $this->isActive;
    }

    /**
     * get user's profile picture
     *
     * @return HasMany
     */
    public function userProfilePics()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_USER_PROFILE);
    }

    /**
     * get user's profile profile info
     *
     * @return HasOne
     */
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'userId', 'id');
    }

    /**
     * is the user in a specific property
     *
     * @param int $propertyId
     * @return true
     */
    public function isUserOfTheProperty($propertyId)
    {
        return $this->isAdmin()
            || $this->isAnEnterpriseUserOfTheProperty($propertyId)
            || $this->isAStaffOfTheProperty($propertyId)
            || $this->isResidentOfTheProperty($propertyId);
    }

    /**
     * get property ids of the enterprise-users
     *
     * @return array
     */
    public function getPropertyIds()
    {
        $propertyIds = [];
        foreach ($this->userRoles as $userRole) {
            if (isset($userRole->propertyId)) {
                $propertyIds[] = $userRole->propertyId;
            }
        }

        $propertyIds = array_merge($propertyIds, $this->getEnterpriseUserPropertyIds());

        return array_unique($propertyIds);
    }

    /**
     * get all roles titles of a user
     *
     * @return array - of strings
     *
     */
    public function getRolesTitles()
    {
        $roles = [];
        foreach ($this->userRoles as $userRole) {
            $roles[] = $userRole->role->title;
        }
        return $roles;
    }

    /**
     *@draft
     */
    public function getUserLabel($userRoles, $residents)
    {
        $roleIds = $userRoles->pluck('roleId')->toArray();
        $label = '';

        foreach ($roleIds as $roleId) {
            if (in_array($roleId, [Role::ROLE_ADMIN_LIMITED['id'], Role::ROLE_ADMIN_STANDARD['id'], Role::ROLE_ADMIN_SUPER['id']])) {
               return 'Admin';
            }
            if (in_array($roleId, [Role::ROLE_STAFF_LIMITED['id'], Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_PRIORITY['id']])) {
                return 'Staff';
            }

            if (in_array($roleId, [Role::ROLE_STAFF_LIMITED['id'], Role::ROLE_STAFF_STANDARD['id'], Role::ROLE_STAFF_PRIORITY['id']])) {
                return 'Staff';
            }

            if (in_array($roleId, [Role::ROLE_RESIDENT_TENANT['id'], Role::ROLE_RESIDENT_OWNER['id']])) {
                $resident = $residents->first();
                if ($resident instanceof Resident) {
                    return $resident->residentLabel;
                }
            }
        }

        return $label;

    }


}
