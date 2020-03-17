<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentInstallmentItem extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'propertyId',
        'paymentInstallmentId',
        'dueDate',
        'amount',
    ];

    /**
     * get the payment
     *
     * @return HasOne
     */
    public function paymentInstallment()
    {
        return $this->hasOne(PaymentInstallment::class, 'id', 'paymentInstallmentId');
    }
}
