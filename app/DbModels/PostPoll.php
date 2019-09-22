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
     * @param array $voteInfo
     * @return mixed
     */
    public function setVotersAttribute($voteInfo)
    {
        $currentVoters = $this->voters;
        $currentVotes = $this->votes;
        $voted = false;

        foreach ($currentVoters as $key => $currentVoter) {
            if ($currentVoter['userId'] == $voteInfo['userId']) {
                $currentVoters[$key]['voteOn'] = $voteInfo['voteOn'];
                if ($currentVotes[$currentVoter['voteOn']] != 0) {
                    $currentVotes[$currentVoter['voteOn']]--;
                }

                $voted = true;
                break;
            }
        }

        if (!$voted) {
            array_push($currentVoters, $voteInfo);
        }

        $currentVotes[$voteInfo['voteOn']]++;
        $this->attributes['votes'] = json_encode($currentVotes);
        $this->attributes['voters'] = json_encode($currentVoters);
    }

    /**
     * get the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'postId');
    }
}
