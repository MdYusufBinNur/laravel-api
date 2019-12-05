<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostMarketplace extends Model
{
    use CommonModelFeatures;

    const TYPE_BUY = 'buy';
    const TYPE_SELL = 'sell';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'type', 'title', 'price', 'description', 'contact',
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
