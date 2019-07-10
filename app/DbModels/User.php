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
        'name', 'email', 'password', 'locale' ,'createdByUserId', 'isActive', 'lastLoginAt'
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
     * is a active user
     *
     * @return bool
     */
    public function isActive()
    {
        return (boolean) $this->isActive;
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
            if ($userRole->isAdminUserRole()) {
                return true;
            }
        }
        return false;
    }

}
