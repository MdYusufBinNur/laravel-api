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
        'createdByUserId', 'roleCategoryId', 'title'
    ];

    // N.B. setting `id` statically for quicker insert
    const ROLE_ADMIN_SUPER = ['id' => 1, 'title' => 'admin_super'];
    const ROLE_ADMIN_STANDARD = ['id' => 2, 'title' => 'standard_admin'];
    const ROLE_ADMIN_LIMITED = ['id' => 3, 'title' => 'limited_admin'];

    const ROLE_ENTERPRISE_ADMIN = ['id' => 4, 'title' => 'enterprise_admin'];
    const ROLE_ENTERPRISE_STANDARD = ['id' => 5, 'title' => 'enterprise_standard'];

    const ROLE_STAFF_PRIORITY = ['id' => 6, 'title' => 'priority_staff'];
    const ROLE_STAFF_STANDARD = ['id' => 7, 'title' => 'standard_staff'];
    const ROLE_STAFF_LIMITED = ['id' => 8, 'title' => 'limited_staff'];

    const ROLE_RESIDENT_TENANT = ['id' => 9, 'title' => 'resident_tenant'];
    const ROLE_RESIDENT_OWNER = ['id' => 10, 'title' => 'resident_owner'];


    /**
     * is a super admin role
     *
     * @return bool
     */
    public function isSuperAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_SUPER['title'];
    }

    /**
     * is a standard admin role
     *
     * @return bool
     */
    public function isStandardAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_STANDARD['title'];
    }

    /**
     * is limited admin role
     *
     * @return bool
     */
    public function isLimitedAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_LIMITED['title'];
    }


    /**
     * is any admin role
     *
     * @return bool
     */
    public function isAdminRole()
    {
        return in_array($this->title, [self::ROLE_ADMIN_SUPER['title'], self::ROLE_ADMIN_SUPER['title'], self::ROLE_ADMIN_LIMITED['title']]);
    }
}
