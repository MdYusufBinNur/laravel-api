<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'property_id', 'created_user_id', 'deleted_user_id', 'type', 'status', 'like_count', 'like_users', 'attachment'
    ];
}
