<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'post_id', 'event_id'
    ];
}
