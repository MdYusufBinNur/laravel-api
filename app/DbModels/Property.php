<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyId', 'type', 'title', 'subdomain', 'address', 'city',
        'state', 'postCode', 'country', 'language', 'timezone', 'active',
        'createdByUserId',
    ];

    /**
     * Get the towers for the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function towers()
    {
        return $this->hasMany(Tower::class);
    }

    /**
     * Get all of the units for the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function units()
    {
        return $this->hasManyThrough(Unit::class, Tower::class);
    }

    /**
     * Get the company of the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
