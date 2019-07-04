<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'address', 'city', 'state', 'postCode', 'country', 'active', 'createdByUserId'
    ];

    /**
     * set default values
     *
     * @var array
     */
    protected $attributes = [
        'active' => 1
    ];

    /**
     * Get the properties for the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany(Property::class,'companyId', 'id');
    }

    /**
     * Get the noOfEnterpriseUsers for the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function noOfEnterpriseUsers()
    {
        return $this->hasManyThrough(UserRole::class, Property::class, 'companyId', 'propertyId', 'id', 'id');
    }

}
