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

    /**
     * setter for voters column
     *
     * @param $userId
     * @return mixed
     */
    public function setVotersAttribute($userId)
    {
        $currentVoters = $this->voters;
        $key = array_search($userId, $currentVoters);
        if ($key === false) {
            array_push($currentVoters, $userId);
            $this->attributes['voters'] = json_encode($currentVoters);
        }
    }
}
