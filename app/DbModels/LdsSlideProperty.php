<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LdsSlideProperty extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'slide_id'
    ];
}
