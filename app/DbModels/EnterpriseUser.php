<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Collection;
use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EnterpriseUser extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'enterprise_admin';
    const LEVEL_STANDARD = 'enterprise_standard';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'userRoleId', 'companyId', 'contactEmail', 'phone', 'title', 'level'
    ];

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the user role
     *
     * @return HasOne
     */
    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'id', 'userRoleId');
    }

    /**
     * get the company related to the enterprise user
     *
     * @return hasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'companyId' );
    }

    /**
     * is admin level
     *
     * @return bool
     */
    public function isAdminLevel()
    {
        return $this->level === self::LEVEL_ADMIN;
    }

    /**
     * is standard level
     *
     * @return bool
     */
    public function isStandardLevel()
    {
        return $this->level === self::LEVEL_STANDARD;
    }

    /**
     * enterprise_user and enterprise_users_properties relationship
     *
     * @return HasMany
     */
    public function enterPriseUserProperties()
    {
        return $this->hasMany(EnterpriseUserProperty::class, 'enterpriseUserId', 'id');
    }

    /**
     * get assigned properties of the enterpriseuser
     *
     * @return Collection
     */
    public function getAssignedProperties()
    {
        $properties = new Collection();
        if ($this->isAdminLevel()) {
            $company = $this->company;
            if ($company instanceof Company) {
                $properties = $company->properties;
            }
        } else {
            $enterPriseUserProperties = $this->enterPriseUserProperties;
            foreach ($enterPriseUserProperties as $enterPriseUserProperty) {
                $properties->add($enterPriseUserProperty->property);
            }
        }

        return $properties;
    }

}
