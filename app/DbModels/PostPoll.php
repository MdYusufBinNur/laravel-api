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
        'createdByUserId', 'postId', 'text', 'votes', 'voters'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'votes' => 'array',
        'voters' => 'array',
        'text' => 'array',
    ];

    protected $attributes = [
        'votes' => "[]",
        'voters' => "[]",
    ];

    public function setTextAttribute($text)
    {
        $this->attributes['text'] = json_encode($text);
    }
}
