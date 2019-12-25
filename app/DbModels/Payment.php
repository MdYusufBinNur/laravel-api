<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use CommonModelFeatures;


    // N.B. setting `id` statically for quicker insert
    const STATUS_DONE = 'done';
    const STATUS_PENDING = 'pending';
    const STATUS_PARTIALLY_DONE = 'partially_done';
    const STATUS_NOT_ACTIVATED = 'not_activated' ;

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
        'dueDays',
        'isRecurring',
        'status',
        'activationDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isRecurring' => 'boolean',
        'dueDate' => 'datetime:Y-m-d h:i',
        'activationDate' => 'datetime:Y-m-d h:i',
    ];

}
