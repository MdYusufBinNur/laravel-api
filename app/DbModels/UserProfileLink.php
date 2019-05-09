<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class UserProfileLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'user_id', 'title', 'url', 'type'
    ];
}
