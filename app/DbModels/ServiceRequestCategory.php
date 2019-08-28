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
        'propertyId', 'parentId', 'title', 'type', 'active', 'createdByUserId'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

}
