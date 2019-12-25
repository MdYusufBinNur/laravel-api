<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostWall extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'text'
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
}
