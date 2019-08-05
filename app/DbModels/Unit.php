<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'towerId', 'propertyId', 'title', 'floor', 'line', 'createdByUserId'
    ];

    /**
     * Get the tower of the unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tower()
    {
        return $this->hasOne(Tower::class, 'id', 'towerId');
    }

    /**
     * user and residents relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class, 'unitId', 'id')->where('propertyId', $this->propertyId);
    }
}
