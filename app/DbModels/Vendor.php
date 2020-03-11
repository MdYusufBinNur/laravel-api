<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'createdByUserId',
        'propertyId',
        'name',
        'email',
        'phone',
        'address',
        'website',
        'note',
    ];
}
