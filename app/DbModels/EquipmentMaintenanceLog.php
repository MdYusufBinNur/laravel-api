<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EquipmentMaintenanceLog extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'equipmentId', 'note', 'nextMaintenanceDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'nextMaintenanceDate' => 'datetime:Y-m-d',
    ];

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the equipment
     *
     * @return HasOne
     */
    public function equipment()
    {
        return $this->hasOne(Equipment::class, 'id', 'equipmentId');
    }
}
