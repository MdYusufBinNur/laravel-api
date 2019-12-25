<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    /**
     * get slide of the property
     *
     * @return HasOne
     */
    public function slide()
    {
        return $this->hasOne(LdsSlide::class, 'id','slideId');
    }

    /**
     * get slide of the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id','propertyId');
    }
}
