<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class CommitteeHierarchy extends Model
{
    use CommonModelFeatures;

    /**
     * Table name
     * @var string
     */
    protected $table = 'committee_hierarchies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'committeeTypeId', 'position', 'title'
    ];
}
