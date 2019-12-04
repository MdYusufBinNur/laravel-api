<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PostRecommendation extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'typeId', 'name', 'description', 'contact', 'website'
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
     * get the recommendation's type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function recommendationType()
    {
        return $this->hasOne(PostRecommendationType::class, 'id', 'typeId');
    }
}
