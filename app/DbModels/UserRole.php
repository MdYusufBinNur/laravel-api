<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use CommonModelFeatures;

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

    /**
     * does the staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesStaffHaveAccessToTheProperty(int $propertyId)
    {
        return $this->hasStaffUserRole()
            && $this->hasThePropertyAssigned($propertyId);
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

    /**
     * is a enterprise's admin user role
     *
     * @return boolean
     */
    public function isAdminEnterpriseUserRole()
    {
        return $this->role->isAdminEnterpriseRole();
    }

    /**
     * is a enterprise's standard user
     *
     * @return boolean
     */
    public function isStandardEnterpriseUserRole()
    {
        return $this->role->isStandardEnterpriseRole();
    }

    /**
     * has any enterprise user role
     *
     * @return boolean
     */
    public function hasEnterpriseUserRole()
    {
        return $this->role->hasEnterpriseRole();
    }

    /**
     * does the staff have access to the property
     *
     * @param int $propertyId
     * @return bool
     */
    public function doesEnterpriseUserRoleHaveAccessToTheProperty(int $propertyId)
    {
        if ($this->isAdminEnterpriseUserRole()) {
            return true;
        }

        if ($this->hasEnterpriseUserRole()) {
            foreach ($this->enterpriseUsers as $enterpriseUser) {
                return in_array($propertyId, $enterpriseUser->enterPriseUserProperties->pluck('propertyId')->toArray());
            }
        }

        return false;
    }

    /**
     * does the staff have access to the company
     *
     * @param int $companyId
     * @return bool
     */
    public function doesEnterpriseUserRoleHaveAdminAccessToTheCompany(int $companyId)
    {
        if ($this->isAdminEnterpriseUserRole()) {
            foreach ($this->enterpriseUsers as $enterpriseUser) {
                return $enterpriseUser->companyId == $companyId;
            }
        }

        return false;
    }

    /**
     * is a owner type resident's user role
     *
     * @return boolean
     */
    public function isOwnerResidentUserRole()
    {
        return $this->role->isOwnerResidentRole();
    }

    /**
     * is a tenant type resident's user role
     *
     * @return boolean
     */
    public function isTenantResidentUserRole()
    {
        return $this->role->isTenantResidentRole();
    }

    /**
     * is a shop type resident's user role
     *
     * @return boolean
     */
    public function isShopResidentUserRole()
    {
        return $this->role->isShopResidentRole();
    }

    /**
     * is a student type resident's user role
     *
     * @return boolean
     */
    public function isStudentResidentUserRole()
    {
        return $this->role->isStudentResidentRole();
    }


    /**
     * has any resident user role
     *
     * @return boolean
     */
    public function hasResidentUserRole()
    {
        return $this->role->hasResidentRole();
    }

}
