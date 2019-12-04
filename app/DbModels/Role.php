<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
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
        'createdByUserId', 'type', 'title'
    ];

    // N.B. setting `id` statically for quicker insert
    const ROLE_ADMIN_SUPER = ['id' => 1, 'type' => 'admin', 'title' => 'super_admin'];
    const ROLE_ADMIN_STANDARD = ['id' => 2, 'type' => 'admin', 'title' => 'standard_admin'];
    const ROLE_ADMIN_LIMITED = ['id' => 3, 'type' => 'admin', 'title' => 'limited_admin'];

    const ROLE_ENTERPRISE_ADMIN = ['id' => 4, 'type' => 'enterprise', 'title' => 'enterprise_admin'];
    const ROLE_ENTERPRISE_STANDARD = ['id' => 5, 'type' => 'enterprise', 'title' => 'enterprise_standard'];

    const ROLE_STAFF_PRIORITY = ['id' => 6, 'type' => 'staff', 'title' => 'priority_staff'];
    const ROLE_STAFF_STANDARD = ['id' => 7, 'type' => 'staff', 'title' => 'standard_staff'];
    const ROLE_STAFF_LIMITED = ['id' => 8, 'type' => 'staff', 'title' => 'limited_staff'];

    const ROLE_RESIDENT_OWNER = ['id' => 9, 'type' => 'resident', 'title' => 'resident_owner'];
    const ROLE_RESIDENT_TENANT = ['id' => 10, 'type' => 'resident', 'title' => 'resident_tenant'];

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
     * is a limited admin role
     *
     * @return bool
     */
    public function isLimitedAdminRole()
    {
        return $this->title === self::ROLE_ADMIN_LIMITED['title'];
    }


    /**
     * has any admin role
     *
     * @return bool
     */
    public function hasAdminRole()
    {
        return in_array($this->title, [self::ROLE_ADMIN_SUPER['title'], self::ROLE_ADMIN_SUPER['title'], self::ROLE_ADMIN_LIMITED['title']]);
    }

    /**
     * is a priority staff role
     *
     * @return bool
     */
    public function isPriorityStaffRole()
    {
        return $this->title === self::ROLE_STAFF_PRIORITY['title'];
    }

    /**
     * is a standard staff role
     *
     * @return bool
     */
    public function isStandardStaffRole()
    {
        return $this->title === self::ROLE_STAFF_STANDARD['title'];
    }

    /**
     * is a limited staff role
     *
     * @return bool
     */
    public function isLimitedStaffRole()
    {
        return $this->title === self::ROLE_STAFF_LIMITED['title'];
    }


    /**
     * has any staff role
     *
     * @return bool
     */
    public function hasStaffRole()
    {
        return in_array($this->title, [self::ROLE_STAFF_PRIORITY['title'], self::ROLE_STAFF_STANDARD['title'], self::ROLE_STAFF_LIMITED['title']]);
    }

    /**
     * is a enterprise's admin role
     *
     * @return bool
     */
    public function isAdminEnterpriseRole()
    {
        return $this->title === self::ROLE_ENTERPRISE_ADMIN['title'];
    }

    /**
     * is a enterprise's standard role
     *
     * @return bool
     */
    public function isStandardEnterpriseRole()
    {
        return $this->title === self::ROLE_ENTERPRISE_STANDARD['title'];
    }

    /**
     * has any enterprise role
     *
     * @return bool
     */
    public function hasEnterpriseRole()
    {
        return in_array($this->title, [self::ROLE_ENTERPRISE_ADMIN['title'], self::ROLE_ENTERPRISE_STANDARD['title']]);
    }

    /**
     * is a owner type residents role
     *
     * @return bool
     */
    public function isOwnerResidentRole()
    {
        return $this->title === self::ROLE_RESIDENT_OWNER['title'];
    }

    /**
     * is a enterprise's admin role
     *
     * @return bool
     */
    public function isTenantResidentRole()
    {
        return $this->title === self::ROLE_RESIDENT_TENANT['title'];
    }

    /**
     * has any resident role
     *
     * @return bool
     */
    public function hasResidentRole()
    {
        return in_array($this->title, [self::ROLE_RESIDENT_OWNER['title'], self::ROLE_RESIDENT_TENANT['title']]);
    }
}
