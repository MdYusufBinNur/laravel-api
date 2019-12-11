<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'createdByUserId', 'postId', 'deletedUserId', 'status', 'text'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];

    /**
     * get the post
     *
     * @return HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'postId');
    }

    /**
     * get the post
     *
     * @return HasOne
     */
    public function deletedUser()
    {
        return $this->hasOne(User::class, 'id', 'deletedUserId');
    }

    /**
     * get the post comment users
     *
     * @return HasMany
     */
    public function postCommentUsers()
    {
        return $this->hasMany(User::class, 'id', 'createdByUserId');
    }

    /**
     * get all the user ids of post comments
     *
     */
    public function getPostCommentUserIds()
    {
        return $this->postCommentUsers()->pluck('id')->toArray();
    }

}
