<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PaymentRecur extends Model
{
    use CommonModelFeatures;

    protected $table = 'payment_recurring';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'propertyId',
        'paymentId',
        'activationDate',
        'expireDate',
        'period'
    ];
}
