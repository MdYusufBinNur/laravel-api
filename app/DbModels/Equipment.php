<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use CommonModelFeatures;

    protected $table = 'equipments';

    const NOTIFY_DURATION_DAY = 'day';
    const NOTIFY_DURATION_WEEK = 'week';
    const NOTIFY_DURATION_BIWEEKLY = 'biweekly';
    const NOTIFY_DURATION_MONTH = 'month';
    const NOTIFY_DURATION_MONTH_THREE = 'three_months';
    const NOTIFY_DURATION_MONTH_SIX = 'six_months';
    const NOTIFY_DURATION_YEAR = 'year';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sku',
        'propertyId',
        'description',
        'location',
        'areaServices',
        'manufacturer',
        'expireDate',
        'modelNumber',
        'requiredService',
        'nextMaintenanceDate',
        'notifyDuration',
        'restockNote',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expireDate' => 'datetime: Y-m-d h:i',
        'nextMaintenanceDate' => 'datetime: Y-m-d h:i',
    ];

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the attachments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_EQUIPMENT);
    }
}
