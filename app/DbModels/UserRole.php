<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * Table name
     * @var string
     */
    public  $table = 'users_roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=[
        'roleId', 'userId'
    ];
}