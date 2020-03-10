<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the CommitteeType
     *
     * @return HasOne
     */
    public function committeeType()
    {
        return $this->hasOne(CommitteeType::class, 'id', 'committeeTypeId');
    }
}
