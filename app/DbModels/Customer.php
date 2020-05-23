<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use CommonModelFeatures;

    public $fillable = [
        'createdByUserId',
        'propertyId',
        'name',
        'email',
        'phone',
        'address',
        'website',
        'billingInfo',
        'additionalNote',
    ];
}
