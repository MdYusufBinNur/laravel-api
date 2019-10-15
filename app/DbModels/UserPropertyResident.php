<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserPropertyResident extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'userId',  'unitId', 'role', 'groups', 'displayUnit', 'displayPublicProfile', 'allowPostNote'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'displayUnit' => 'boolean',
        'displayPublicProfile' => 'boolean',
        'allowPostNote' => 'boolean',
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

    /**
     * get the property
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unitId');
    }
}
