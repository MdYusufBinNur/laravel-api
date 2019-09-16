<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use CommonModelFeatures;

    const STATUS_ACTIVE = 'active';
    const STATUS_ARCHIVE = 'archive';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'signinUserId', 'unitId', 'visitorTypeId', 'name', 'phone', 'email', 'company', 'photo', 'permanent', 'comment', 'signature', 'status', 'signinAt'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'photo' => 'boolean',
        'permanent' => 'boolean',
        'signature' => 'boolean',
        'signinAt' => 'datetime:Y-m-d h:i',
    ];
}
