<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EnterpriseUserProperty extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'enterpriseUserId', 'propertyId', 'active'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * get the enterprise user
     *
     * @return HasOne
     */
    public function enterpriseUser()
    {
        return $this->hasOne(EnterpriseUser::class, 'id', 'enterpriseUserId');
    }

    /**
     * get the property related to the enterprise user
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId' );
    }
}
