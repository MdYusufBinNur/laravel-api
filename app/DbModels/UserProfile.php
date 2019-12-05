<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'createdByUserId', 'userId', 'gender', 'occupation', 'homeTown', 'birthDate', 'language', 'website', 'facebookUsername', 'twitterUsername', 'aboutMe', 'interests'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birthDate' => 'datetime:h:i',
        'interests' => 'json'
    ];


    /**
     * get user's profile profile links
     *
     * @return HasMany
     */
    public function userProfileLinks()
    {
        return $this->hasMany(UserProfileLink::class, 'userId', 'userId');
    }

    /**
     * get user's profile profile child info
     *
     * @return HasMany
     */
    public function userProfileChildren()
    {
        return $this->hasMany(UserProfileChild::class, 'userId', 'userId');
    }
}
