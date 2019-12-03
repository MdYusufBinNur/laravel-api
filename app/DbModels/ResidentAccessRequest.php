<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ResidentAccessRequest extends Model
{
    use CommonModelFeatures;

    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'unitId', 'name', 'email', 'phone', 'pin', 'type', 'groups', 'status', 'active', 'comment', 'moderatedUserId', 'moderatedAt', 'movedInDate', 'birthDate'
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'moderatedAt' => 'datetime:Y-m-d h:i',
        'movedInDate' => 'datetime:Y-m-d',
        'birthDate' => 'datetime:Y-m-d',
    ];

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }
}
