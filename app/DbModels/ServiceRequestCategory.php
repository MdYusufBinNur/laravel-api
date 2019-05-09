<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestCategory extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'property_id', 'parent_id', 'title', 'type', 'active', 'createdByUserId'
    ];
}
