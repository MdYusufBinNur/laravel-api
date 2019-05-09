<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'gender', 'occupation', 'home_town', 'birth_date', 'language', 'website', 'facebook_username', 'twitter_username', 'about_me'
    ];
}
