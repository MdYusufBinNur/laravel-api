<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use CommonModelFeatures;

    const LEVEL_ADMIN = 'admin';
    const LEVEL_STANDARD = 'standard';
    const LEVEL_LIMITED = 'limited';
    const LEVEL_RESTRICTED = 'restricted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'propertyId', 'contactEmail', 'phone', 'title', 'level', 'displayInCorner', 'displayPublicProfile'
    ];

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the user roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\Hasmany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId', 'userId');
    }
}
