<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * Get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * Get the tower of the unit
     *
     * @return HasOne
     */
    public function tower()
    {
        return $this->hasOne(Tower::class, 'id', 'towerId');
    }

    /**
     * user and residents relationship
     *
     * @return HasMany
     */
    public function residents()
    {
        return $this->hasMany(Resident::class, 'unitId', 'id')->where('propertyId', $this->propertyId);
    }

    /**
     * get residents users' ids
     *
     * @return array
     */
    public function getResidentsUserIds()
    {
        return $this->residents()->pluck('userId')->toArray();
    }

    /**
     * get residents users' ids
     *
     * @return array
     */
    public function getResidentsContactEmails()
    {
        return $this->residents()->pluck('emails')->toArray();
    }
}
