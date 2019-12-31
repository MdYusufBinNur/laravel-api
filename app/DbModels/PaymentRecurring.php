<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentRecurring extends Model
{
    use CommonModelFeatures;

    protected $table = 'payment_recurring';

    const PERIOD_EVERY_DAY = 'every_day';
    const PERIOD_EVERY_WEEK = 'every_week';
    const PERIOD_EVERY_MONTH = 'every_month';
    const PERIOD_EVERY_THREE_MONTHS = 'every_three_months';
    const PERIOD_TWICE_A_YEAR = 'twice_a_year';
    const PERIOD_EVERY_YEAR = 'every_year';
    const PERIOD_SPECIFIC_DATE = 'specific_date';

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
     * get the last published logs
     *
     * @return PaymentPublishLog
     */
    public function getLastPublishedLog()
    {
        return $this->payment->paymentPublishLogs->last();
    }

    /**
     * has the recurring payment expired
     *
     * @return bool
     */
    public function hasExpired()
    {
        return $this->attributes['expireDate'] < Carbon::today();
    }

    /**
     * get publishable date by period
     *
     * @param null $activationDate
     * @return Carbon|null
     */
    public function getNextPublishableDateByPeriod($activationDate = null)
    {
        $date = null;
        $activationDate = $activationDate instanceof Carbon ? $activationDate : $this->payment->activationDate;
        $lastPublishedLog = $this->getLastPublishedLog();

        switch ($this->attributes['period']) {
            case self::PERIOD_EVERY_DAY:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->isToday() : Carbon::tomorrow();
                break;
            case self::PERIOD_EVERY_WEEK:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->setTime(0, 0, 0)->addDays(7) : $activationDate->addDays(7);
                break;
            case self::PERIOD_EVERY_MONTH:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->setTime(0, 0, 0)->addMonth() : $activationDate->addMonth(30);
                break;
            case self::PERIOD_EVERY_THREE_MONTHS:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->setTime(0, 0, 0)->addMonths(3) : $activationDate->addMonths(3);
                break;
            case self::PERIOD_TWICE_A_YEAR:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->setTime(0, 0, 0)->addMonths(6) : $activationDate->addMonths(6);
                break;
            case self::PERIOD_EVERY_YEAR:
                $date = $lastPublishedLog instanceof PaymentPublishLog ? $lastPublishedLog->created_at->setTime(0, 0, 0)->addYear() : $activationDate->addYear();
                break;
        }

        return $date;
    }
    /**
     * is it a publishing date
     *
     * @return boolean
     */
    public function isPublishingDate($date = null)
    {
        $payment = $this->payment;
        if ($payment instanceof Payment) {
            if ($payment->hasActivationDatePassed()) {
                if (!$this->hasExpired()) {
                    $nextPublishAbleDate = $this->getNextPublishableDateByPeriod($payment->activationDate);
                    if ($nextPublishAbleDate instanceof Carbon) {
                        $date = $date instanceof Carbon ? $date : Carbon::today();
                        return $nextPublishAbleDate->isSameDay($date);
                    }
                }
            }
        }

        return false;
    }
}
