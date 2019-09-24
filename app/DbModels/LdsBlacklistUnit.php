<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsBlacklistUnit extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId'
    ];

    /**
     * get slide of the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id','propertyId');
    }

    /**
     * get slide of the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id','unitId');
    }
}
