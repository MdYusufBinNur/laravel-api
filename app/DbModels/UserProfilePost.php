<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfilePost extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'by_user_id', 'to_user_id', 'text', 'active'
    ];
}
