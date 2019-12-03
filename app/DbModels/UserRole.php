<?php

namespace App\DbModels;

use App\DbModels\Traits\UserRoles\AdminRoleMethods;
use App\DbModels\Traits\UserRoles\EnterpriseRoleMethods;
use App\DbModels\Traits\UserRoles\ResidentRoleMethods;
use App\DbModels\Traits\UserRoles\StaffRoleMethods;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use CommonModelFeatures, AdminRoleMethods, EnterpriseRoleMethods, ResidentRoleMethods, StaffRoleMethods;

    /**
     * Table name
     * @var string
     */
    protected $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roleId', 'userId', 'propertyId', 'createdByUserId'
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
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * user and enterprise_users relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enterpriseUsers()
    {
        return $this->hasMany(EnterpriseUser::class, 'userId', 'userId');
    }


    /**
     * has the user's role assigned to the property
     *
     * @param int $propertyId
     * @return boolean
     */
    public function hasThePropertyAssigned(int $propertyId)
    {
        return $this->property->id === $propertyId;
    }

}
