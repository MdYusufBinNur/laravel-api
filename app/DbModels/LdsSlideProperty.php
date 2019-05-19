<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LdsSlideProperty extends Pivot
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'slideId'
    ];
}
