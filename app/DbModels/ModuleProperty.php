<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'module_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'moduleId', 'value'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'value' => 'boolean',
    ];
}
