<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'postId');
    }

    /**
     * get the event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'eventId');
    }

    /**
     * get the User who created the PostEvent
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserId');
    }
}
