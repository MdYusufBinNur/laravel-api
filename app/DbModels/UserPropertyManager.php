<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserPropertyManager extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId', 'role', 'title', 'phone', 'displayInCorner', 'displayPublicProfile'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'displayInCorner' => 'boolean',
        'displayPublicProfile' => 'boolean',
    ];


    /**
     * get the user
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the property
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }
}
