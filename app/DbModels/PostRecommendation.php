<?php

namespace App\DbModels;

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
}
