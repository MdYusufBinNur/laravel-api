<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostApprovalArchive extends Model
{
    use CommonModelFeatures;

    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'status', 'reason'
    ];

    /**
     * get the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'postId');
    }
}
