<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Table name
     * @var string
     */
    protected  $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'roleId', 'userId', 'propertyId'
    ];

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the role of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }

    /**
     * get the property related to the user's role
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId' );
    }

    /**
     * is a super admin user
     *
     * @return boolean
     */
    public function isSuperAdminUserRole()
    {
        return $this->role->isSuperAdminRole();
    }

    /**
     * is a standard admin user
     *
     * @return boolean
     */
    public function isStandardAdminUserRole()
    {
        return $this->role->isStandardAdminRole();
    }

    /**
     * is a limited admin user
     *
     * @return boolean
     */
    public function isLimitedAdminUserRole()
    {
        return $this->role->isLimitedAdminRole();
    }

    /**
     * has any admin user role
     *
     * @return boolean
     */
    public function hasAdminUserRole()
    {
        return $this->role->hasAdminRole();
    }


    /**
     * is a priority staff user
     *
     * @return boolean
     */
    public function isPriorityStaffUserRole()
    {
        return $this->role->isSuperStaffRole();
    }

    /**
     * is a standard staff user
     *
     * @return boolean
     */
    public function isStandardStaffUserRole()
    {
        return $this->role->isStandardStaffRole();
    }

    /**
     * is a limited staff user
     *
     * @return boolean
     */
    public function isLimitedStaffUserRole()
    {
        return $this->role->isLimitedStaffRole();
    }

    /**
     * has any staff user role
     *
     * @return boolean
     */
    public function hasStaffUserRole()
    {
        return $this->role->hasStaffRole();
    }

}
