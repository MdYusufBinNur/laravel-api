<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfileChild extends Model
{
    use CommonModelFeatures;

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'gender', 'name', 'age'
    ];
}
