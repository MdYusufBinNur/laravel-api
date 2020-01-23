<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
    const STATUS_CANCELLED = 'cancelled';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId',
        'title',
        'propertyId',
        'paymentTypeId',
        'amount',
        'note',
        'billingInfo',
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
        //'toUserIds' => 'json',
        //'toUnitIds' => 'json',
        'dueDate' => 'datetime:Y-m-d h:i',
        'activationDate' => 'datetime:Y-m-d h:i',
    ];

    /**
     * toUserId setter
     *
     * @param $toUserIds
     */
    public function setToUserIdsAttribute($toUserIds)
    {
        $toUserIds = array_map('intval', $toUserIds);

        $this->attributes['toUserIds'] = json_encode($toUserIds);
    }

    /**
     * toUserId getter
     */
    public function getToUserIdsAttribute()
    {
        return isset($this->attributes['toUserIds']) ? json_decode($this->attributes['toUserIds']) : [];
    }

    /**
     * toUnitIds setter
     *
     * @param $toUnitIds
     */
    public function setToUnitIdsAttribute($toUnitIds)
    {
        $toUnitIds = array_map('intval', $toUnitIds);

        $this->attributes['toUnitIds'] = json_encode($toUnitIds);
    }

    /**
     * toUnitIds getter
     */
    public function getToUnitIdsAttribute()
    {
        return isset($this->attributes['toUnitIds']) ? json_decode($this->attributes['toUnitIds']) : [];
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
     * get the payment method
     *
     * @return HasMany
     */
    public function paymentPaymentMethods()
    {
        return $this->hasMany(PaymentPaymentMethod::class, 'paymentId', 'id');
    }

    /**
     * get the payment type
     *
     * @return HasOne
     */
    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, 'id', 'paymentTypeId');
    }

    /**
     * payment and payment-item relationship
     *
     * @return HasMany
     */
    public function paymentItems()
    {
        return $this->hasMany(PaymentItem::class, 'paymentId', 'id');
    }

    /**
     * payment and payment-item relationship
     *
     * @return HasMany
     */
    public function paymentPublishLogs()
    {
        return $this->hasMany(PaymentPublishLog::class, 'paymentId', 'id');
    }

    /**
     * get the payment recurring
     *
     * @return HasOne
     */
    public function paymentRecurring()
    {
        return $this->hasOne(PaymentRecurring::class, 'paymentId', 'id');
    }


    /**
     * check if payment item is paid or not
     *
     * @return bool
     */
    public function hasAllPaymentItemsPaid()
    {
        return $this->paymentItems()->where('status','<>',  PaymentItem::STATUS_PAID)->doesntExist();
    }
    /**
     * check if payment is published nor not
     *
     * @return bool
     */
    public function hasPublished()
    {
        return  $this->attributes['status'] !== self::STATUS_NOT_PUBLISHED;
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

    /**
     * is the model change/update able
     *
     * @return bool
     */
    public function isUpdateAble()
    {
        if (in_array($this->attributes['status'], [self::STATUS_NOT_PUBLISHED, self::STATUS_NOT_ACTIVATED])) {
            return true;
        }

        return false;
    }

    /**
     * is the model change/update-able
     *
     * @return bool
     */
    public function isPublishAble()
    {
        if ($this->isUpdateAble() && $this->hasActivationDatePassed()) {
            return true;
        }

        return false;
    }

}
