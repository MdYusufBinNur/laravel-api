<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentItemPartial extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId',
        'createdByUserId',
        'paymentMethodId',
        'paymentItemId',
        'amount',
        'note',
        'paymentDate'
    ];


    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the payment
     *
     * @return HasOne
     */
    public function paymentItem()
    {
        return $this->hasOne(PaymentItem::class, 'id', 'paymentItemId');
    }

    /**
     * get the payment
     *
     * @return HasOne
     */
    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'paymentMethodId');
    }
}
