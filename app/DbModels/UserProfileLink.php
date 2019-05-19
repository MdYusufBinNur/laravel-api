<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfileLink extends Model
{
    use CommonModelFeatures;

    const TYPE_WEBSITE = 'website';
    const TYPE_COMPANY = 'company';
    const TYPE_FACEBOOK = 'facebook';
    const TYPE_LINKEDIN = 'linkedin';
    const TYPE_MYSPACE = 'myspace';
    const TYPE_OTHER = 'other';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'userId', 'title', 'url', 'type'
    ];
}
