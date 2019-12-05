<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostEvent extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'postId', 'eventId'
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
     * get the event
     *
     * @return HasOne
     */
    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'eventId');
    }

    /**
     * get the User who created the PostEvent
     *
     * @return HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserId');
    }
}
