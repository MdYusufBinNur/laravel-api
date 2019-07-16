<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class EnterpriseUser extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'companyId', 'contactEmail', 'phone', 'title', 'level'
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
     * get the company related to the enterprise user
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'companyId' );
    }

    /**
     * enterprise_user and enterprise_users_properties relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enterPriseUserProperties()
    {
        return $this->hasMany(EnterpriseUserProperty::class, 'enterpriseUserId', 'id');
    }

}
