<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentItemTransaction extends Model
{
    use CommonModelFeatures;

    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_REJECTED = 'rejected';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId',
        'paymentItemId',
        'providerName',
        'providerId',
        'status',
        'sourceURL',
        'paymentProcessURL',
        'rawData'
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
     * get the payment
     *
     * @return HasOne
     */
    public function paymentItem()
    {
        return $this->hasOne(PaymentItem::class, 'id', 'paymentItemId');
    }
}
