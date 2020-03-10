<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    /**
     * Table name
     * @var string
     */
    protected $table = 'committees';

    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'committeeTypeId', 'committeeSessionId', 'committeeHierarchyId',  'userId', 'name'
    ];
}
