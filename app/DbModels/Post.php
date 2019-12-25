<?php

namespace App\DbModels;

use App\DbModels\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use CommonModelFeatures;

    const TYPE_MARKETPLACE = 'marketplace';
    const TYPE_WALL = 'wall';
    const TYPE_RECOMMENDATION = 'recommend';
    const TYPE_EVENT = 'event';
    const TYPE_POLL = 'poll';

    const STATUS_POSTED = 'posted';
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DENIED = 'denied';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdByUserId', 'propertyId', 'deletedUserId', 'type', 'status', 'likeCount', 'likeUsers', 'attachment'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachment' => 'boolean',
        'likeUsers' => 'array'
    ];

    protected $attributes = [
        'status' => self::STATUS_POSTED,
        'likeCount' => 0,
        'likeUsers' => "[]",
    ];

    /**
     * setter for likeUsers column
     * - it will also handle like count
     *
     * @param $userId
     * @return mixed
     */
    public function setLikeUsersAttribute($userId)
    {
        $currentLikedUsers = $this->likeUsers;
        $key = array_search($userId, $currentLikedUsers);
        if ($key === false) {
            array_push($currentLikedUsers, $userId);
            $this->attributes['likeUsers'] = json_encode($currentLikedUsers);
            $this->attributes['likeCount']++;
        } else {
            unset($currentLikedUsers[$key]);
            $this->attributes['likeCount']--;
            $this->attributes['likeUsers'] = json_encode($currentLikedUsers);
        }
    }

    /**
     * get the property
     *
     * @return HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the details based on type
     *
     * @return HasMany
     */
    public function detailByType()
    {
        return !empty($this->getDetailClassByType())
            ? $this->hasMany($this->getDetailClassByType(), 'postId')
            : null;
    }

    /**
     * post has different types,
     * get the relationship class by types
     *
     * @return string
     */
    private function getDetailClassByType()
    {
        $detailClass = '';

        switch ($this->type) {
            case self::TYPE_WALL:
                $detailClass = PostWall::class;
                break;
            case self::TYPE_RECOMMENDATION:
                $detailClass = PostRecommendation::class;
                break;
            case self::TYPE_POLL:
                $detailClass = PostPoll::class;
                break;
            case self::TYPE_MARKETPLACE:
                $detailClass = PostMarketplace::class;
                break;
            case self::TYPE_EVENT:
                $detailClass = PostEvent::class;
                break;
        }

        return $detailClass;
    }

    /**
     * get the attachments
     *
     * @return HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_POST);
    }

    /**
     * get the comments
     *
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'postId');
    }

    /**
     * get the post approval archive
     *
     * @return HasMany
     */
    public function approvalArchives()
    {
        return $this->hasMany(PostApprovalArchive::class, 'postId');
    }

    /**
     * get the User who created the Post
     *
     * @return HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserId');
    }

    /**
     * get the post comment users
     *
     */
    public function postCommentUsers()
    {
        $ids = $this->comments()->pluck('createdByUserId')->toArray();
        return array_unique($ids);
    }
}
