<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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
