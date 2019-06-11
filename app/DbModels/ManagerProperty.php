<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ManagerProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'manager_property';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'managerId', 'propertyId', 'active'
    ];
}
