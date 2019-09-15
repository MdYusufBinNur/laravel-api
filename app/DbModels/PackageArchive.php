<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function package()
    {
        return $this->hasOne(Package::class,'id','packageId');
    }

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the signOutUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function signOutUser()
    {
        return $this->hasOne(User::class, 'id', 'signOutUserId');
    }
}
