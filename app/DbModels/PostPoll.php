<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostPoll extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'post_id', 'text', 'votes', 'voters'
    ];
}
