<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'post_id', 'created_user_id', 'deleted_user_id', 'status', 'text', 'active'
    ];
}
