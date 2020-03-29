<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentItem extends Model
{
    use CommonModelFeatures;

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_PARTIAL = 'partial';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'paymentId',
        'propertyId',
        'userId',
        'unitId',
        'vendorId',
        'customerId',
        'paymentInstallmentItemId',
        'status',
        'note',
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING
    ];

    /**
     * is the item paid
     *
     * @return bool
     */
    public function isPaid()
    {
        return  $this->attributes['status'] == self::STATUS_PAID;
    }

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
    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'paymentId');
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
     * get the vendor
     *
     * @return HasOne
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class, 'id', 'vendorId');
    }

    /**
     * get the customer
     *
     * @return HasOne
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customerId');
    }

    /**
     * payment-item and payment-item-logs relationship
     *
     * @return HasMany
     */
    public function paymentItemLogs()
    {
        return $this->hasMany(PaymentItemLog::class, 'paymentItemId', 'id');
    }

    /**
     * payment-item and payment-item-partial relationship
     *
     * @return HasMany
     */
    public function paymentItemPartials()
    {
        return $this->hasMany(PaymentItemPartial::class, 'paymentItemId', 'id');
    }

    /**
     * get the payment-installment-item
     *
     * @return HasOne
     */
    public function paymentInstallmentItem()
    {
        return $this->hasOne(PaymentInstallmentItem::class, 'id', 'paymentInstallmentItemId');
    }
}
