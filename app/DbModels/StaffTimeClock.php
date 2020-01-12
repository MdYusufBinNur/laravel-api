<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StaffTimeClock extends Model
{
    use CommonModelFeatures;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manager_time_clocks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'managerId', 'createdByUserId', 'clockedIn', 'clockedOut'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'clockedIn' => 'datetime:H:i',
        'clockedOut' => 'datetime:H:i',
    ];


    /**
     * get the property
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }
}
