<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostRecommendationType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'title'
    ];
}
