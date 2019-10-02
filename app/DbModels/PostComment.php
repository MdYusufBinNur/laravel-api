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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'postId');
    }

    /**
     * get the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function deletedUser()
    {
        return $this->hasOne(User::class, 'id', 'deletedUserId');
    }

    /**
     * get the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdUser()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserId');
    }
}
