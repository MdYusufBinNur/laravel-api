<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LdsSlideProperty extends Pivot
{
    use CommonModelFeatures;

    protected $table = 'lds_slide_properties';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'slideId'
    ];
}
