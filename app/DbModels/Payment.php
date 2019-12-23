<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'title',
        'propertyId',
        'paymentMethodId',
        'paymentTypeId',
        'amount',
        'note',
        'dueDate',
        'isRecurring',
        'status',
        'activationDate'
    ];
}
