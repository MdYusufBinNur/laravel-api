<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Table name
     * @var string
     */
    protected  $table = 'user_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'roleId', 'userId', 'propertyId'
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
     * get role of the users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }
}
