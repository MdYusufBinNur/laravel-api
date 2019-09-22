<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function visitor()
    {
        return $this->hasOne(Visitor::class, 'id', 'visitorId')->withTrashed();
    }
}
