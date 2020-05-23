<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use CommonModelFeatures;

    protected $fillable = [
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
