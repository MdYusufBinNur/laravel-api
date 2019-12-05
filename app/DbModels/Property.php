<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Property extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyId', 'type', 'title', 'domain', 'subdomain', 'address', 'city',
        'state', 'postCode', 'country', 'language', 'timezone', 'unregisteredResidentNotifications', 'active',
        'latitude', 'longitude', 'point', 'createdByUserId',
    ];

    protected $casts = [
        'active' => 'boolean',
        'unregisteredResidentNotifications' => 'boolean',
    ];

    
    /**
     * Get the towers for the property.
     *
     * @return HasMany
     */
    public function towers()
    {
        return $this->hasMany(Tower::class, 'propertyId', 'id');
    }

    /**
     * Get all of the units for the property.
     *
     * @return hasManyThrough
     */
    public function units()
    {
        return $this->hasManyThrough(Unit::class, Tower::class, 'propertyId', 'towerId', 'id', 'id');
    }

    /**
     * Get the company of the property
     *
     * @return BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }

    /**
     * Get the users for the property.
     *
     * @return HasMany
     */
    public function users()
    {
        return $this->hasMany(UserRole::class, 'propertyId', 'id');
    }

    /**
     * get images
     *
     * @return HasMany
     */
    public function propertyImages()
    {
        return $this->hasMany(PropertyImage::class, 'propertyId', 'id');
    }

    /**
     * get images
     *
     * @return HasOne
     */
    public function propertyDesignSetting()
    {
        return $this->hasOne(PropertyDesignSetting::class, 'propertyId', 'id');
    }

    /**
     * get the login link
     *
     * @return mixed|string
     */
    public function getLoginLink()
    {
        if (!empty($this->domain)) {
            return $this->domain;
        } else {
            return $this->subdomain . '.' . env('BRAND_SITE');
        }
    }
}
