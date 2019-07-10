<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ModuleOptionProperty extends Model
{
    use CommonModelFeatures;

    protected $table = 'module_option_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'moduleOptionId', 'value'
    ];
}
