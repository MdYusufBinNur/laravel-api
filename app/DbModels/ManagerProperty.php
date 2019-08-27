<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ManagerProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'manager_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'managerId', 'propertyId', 'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];
}
