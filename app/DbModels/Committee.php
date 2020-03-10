<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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


    /**
     * get the CommitteeSession
     *
     * @return HasOne
     */
    public function committeeSession()
    {
        return $this->hasOne(CommitteeType::class, 'id', 'committeeSessionId');
    }

    /**
     * get the CommitteeHierarchy
     *
     * @return HasOne
     */
    public function committeeHierarchy()
    {
        return $this->hasOne(CommitteeType::class, 'id', 'committeeHierarchyId');
    }

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }
}
