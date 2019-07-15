<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId','roleCategoryId', 'title'
    ];

    const ROLE_SUPER_ADMIN = 'super';
    const ROLE_STANDARD_ADMIN = 'standard';
    const ROLE_LIMITED_ADMIN = 'limited';

    const ROLE_ENTERPRISE_USER = 'enterprise';

    /**
     * get the role category of the role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function roleCategory()
    {
        return $this->hasOne(RoleCategory::class, 'id', 'roleCategoryId');
    }

    /**
     * is a super admin role
     *
     * @return bool
     */
    public function isSuperAdminRole()
    {
        return $this->roleCategory->isAdminRoleCategory() && $this->title === self::ROLE_SUPER_ADMIN;
    }

    /**
     * is a standard admin role
     *
     * @return bool
     */
    public function isStandardAdminRole()
    {
        return $this->roleCategory->isAdminRoleCategory() && $this->title === self::ROLE_STANDARD_ADMIN;
    }

    /**
     * is limited admin role
     *
     * @return bool
     */
    public function isLimitedAdminRole()
    {
        return $this->roleCategory->isAdminRoleCategory() && $this->title === self::ROLE_LIMITED_ADMIN;
    }


    /**
     * is any admin role
     *
     * @return bool
     */
    public function isAdminRole()
    {
        return $this->roleCategory->isAdminRoleCategory();
    }
}
