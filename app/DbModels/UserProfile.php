<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
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
        'createdByUserId', 'userId', 'gender', 'occupation', 'homeTown', 'birthDate', 'language', 'website', 'facebookUsername', 'twitterUsername', 'aboutMe'
    ];
}
