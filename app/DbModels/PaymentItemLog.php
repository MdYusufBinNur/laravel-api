<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentItemLog extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paymentItemId',
        'propertyId',
        'userId',
        'unitId',
        'status',
        'updatedByUserId'
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
     * get the unit
     *
     * @return HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
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
     * get the user
     *
     * @return HasOne
     */
    public function updatedByUser()
    {
        return $this->hasOne(User::class, 'id', 'updatedByUserId');
    }
}
