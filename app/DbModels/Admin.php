<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use CommonModelFeatures;

    //FYI, it has to be matched with its corresponding user role
    const LEVEL_SUPER = 'super_admin';
    const LEVEL_STANDARD = 'standard_admin';
    const LEVEL_LIMITED = 'limited_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'userRoleId', 'level'
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
     * get the user role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'id', 'userRoleId');
    }
}
