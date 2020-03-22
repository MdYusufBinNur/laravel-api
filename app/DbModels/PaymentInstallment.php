<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentInstallment extends Model
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
        'paymentId',
        'numberOfInstallments',
    ];

    /**
     * get the payment
     *
     * @return HasOne
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
    }

    /**
     * get the payment method
     *
     * @return HasMany
     */
    public function paymentInstallmentItems()
    {
        return $this->hasMany(PaymentInstallmentItem::class, 'paymentInstallmentId', 'id');
    }
}
