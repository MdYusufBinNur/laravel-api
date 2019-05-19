<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use CommonModelFeatures;

    const STATUS_POSTED = 'posted';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'createdUserId', 'deletedUserId', 'status', 'text', 'active'
    ];
}
