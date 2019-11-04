<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use CommonModelFeatures;

    protected $table = 'equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'propertyId',
        'description',
        'location',
        'areaServices',
        'manufacturer',
        'expireDate',
        'modelNumber',
        'requiredService',
        'nextMaintenanceDate',
        'notifyDuration',
        'restockNote',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expireDate' => 'datetime: Y-m-d h:i',
        'nextMaintenanceDate' => 'datetime: Y-m-d h:i',
    ];
}
