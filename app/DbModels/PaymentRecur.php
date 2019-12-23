<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PaymentRecur extends Model
{
    use CommonModelFeatures;

    protected $table = 'payment_recurring';

    const PERIOD_EVERY_DAY = 'every_day';
    const PERIOD_EVERY_WEEK = 'every_week';
    const PERIOD_EVERY_MONTH = 'every_month';
    const PERIOD_EVERY_THREE_MONTHS = 'every_three_months';
    const PERIOD_TWICE_A_YEAR = 'twice_a_year';
    const PERIOD_EVERY_YEAR = 'every_year';
    const PERIOD_SPECIFIC_DATES = 'specific_dates';

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
