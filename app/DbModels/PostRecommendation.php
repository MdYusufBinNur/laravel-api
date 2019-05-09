<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

class PostRecommendation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'post_id', 'type_id', 'name', 'description', 'contact', 'website'
    ];
}
