<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CommitteeSession extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'committeeTypeId', 'sessionName', 'startedDate', 'endedDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'startedDate' => 'date_format:Y-m-d',
        'endedDate' => 'date_format:Y-m-d',
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
     * get the CommitteeType
     *
     * @return HasOne
     */
    public function committeeType()
    {
        return $this->hasOne(CommitteeType::class, 'id', 'committeeTypeId');
    }
}
