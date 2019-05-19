<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestCategory extends Model
{
    use CommonModelFeatures;

    const TYPE_UNIT = 'unit';
    const TYPE_COMMON = 'commonArea';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'parent_id', 'title', 'type', 'active', 'createdByUserId'
    ];
}
