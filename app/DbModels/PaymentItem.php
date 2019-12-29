<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PaymentItem extends Model
{
    use CommonModelFeatures;

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_CANCELLED = 'cancelled';

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
        'status'
    ];

    protected $attributes = [
        'status' => self::STATUS_PENDING
    ];

    public function isPaid()
    {
        return  $this->attributes['status'] == self::STATUS_PAID;
    }
}
