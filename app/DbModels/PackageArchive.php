<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PackageArchive extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'packageId', 'propertyId', 'signOutUserId', 'signOutComment', 'signature', 'signOutAt',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'signature' => 'boolean',
        'signOutAt' => 'datetime:Y-m-d h:i',
    ];

    /**
     * get the package
     *
     * @return HasOne
     */
    public function package()
    {
        return $this->hasOne(Package::class,'id','packageId')->withTrashed();
    }

    /**
     * get the property
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the signOutUser
     *
     * @return hasOne
     */
    public function signOutUser()
    {
        return $this->hasOne(User::class, 'id', 'signOutUserId');
    }
}
