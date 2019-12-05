<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VisitorArchive extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'visitorId', 'signOutUserId', 'signature', 'signOutAt'
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
     * get the property
     *
     * @return hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the visitor
     *
     * @return hasOne
     */
    public function visitor()
    {
        return $this->hasOne(Visitor::class, 'id', 'visitorId')->withTrashed();
    }

    /**
     * get the sign out user
     *
     * @return hasOne
     */
    public function signOutUser()
    {
        return $this->hasOne(User::class, 'id', 'signOutUserId');
    }
}
