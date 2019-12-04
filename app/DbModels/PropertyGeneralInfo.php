<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PropertyGeneralInfo extends Model
{
    use CommonModelFeatures;

    /**
     * Table name
     * @var string
     */
    protected $table = 'property_general_infos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'phone', 'email', 'emergenceContact', 'additionalInfo', 'officeHours'
    ];

}
