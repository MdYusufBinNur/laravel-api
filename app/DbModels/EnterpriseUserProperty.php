<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

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
     * get the enterprise user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function enterpriseUser()
    {
        return $this->hasOne(EnterpriseUser::class, 'id', 'enterpriseUserId');
    }

    /**
     * get the property related to the enterprise user
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId' );
    }
}
