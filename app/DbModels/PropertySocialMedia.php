<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PropertySocialMedia extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'url', 'type'
    ];
}
