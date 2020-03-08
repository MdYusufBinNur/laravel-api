<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PropertyCommittee extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'propertyId', 'committeeTypeId', 'committeeSessionId', 'userId', 'name', 'committeeRankId'
    ];
}
