<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class LdsBlacklistUnit extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'unit_id'
    ];
}
