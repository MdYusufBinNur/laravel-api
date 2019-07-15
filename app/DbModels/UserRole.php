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
     * get role of the users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
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
     * is a admin user role
     *
     * @return boolean
     */
    public function isAdminUserRole()
    {
        return $this->role->isAdminRole();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId' );
    }
}
