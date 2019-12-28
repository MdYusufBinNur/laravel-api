<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use CommonModelFeatures;

    const STATUS_DONE = 'done';
    const STATUS_PENDING = 'pending';
    const STATUS_PARTIALLY_DONE = 'partially_done';
    const STATUS_NOT_ACTIVATED = 'not_activated';
    const STATUS_NOT_PUBLISHED = 'not_published'; // when the payment_item has not been created yet

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
        'toUserIds',
        'toUnitIds',
        'activationDate'
    ];

    protected $attributes = [
        'status' => self::STATUS_NOT_PUBLISHED
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'isRecurring' => 'boolean',
        'toUserIds' => 'json',
        'toUnitIds' => 'json',
        'dueDate' => 'datetime:Y-m-d h:i',
        'activationDate' => 'datetime:Y-m-d h:i',
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
     * get the payment method
     *
     * @return HasOne
     */
    public function paymentMethod()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'paymentMethodId');
    }

    /**
     * get the payment type
     *
     * @return HasOne
     */
    public function paymentType()
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'paymentTypeId');
    }

    /**
     * user and roles relationship
     *
     * @return HasMany
     */
    public function paymentItems()
    {
        return $this->hasMany(PaymentItem::class, 'paymentId', 'id');
    }

    /**
     * check if payment is published nor not
     *
     * @return bool
     */
    public function hasPublished()
    {
        return $this->attributes['status'] !== self::STATUS_NOT_PUBLISHED;
    }

    /**
     * check if payment's activation date passed
     *
     * @return bool
     */
    public function hasActivationDatePassed()
    {
        return $this->attributes['activationDate'] <= Carbon::today();
    }

}
