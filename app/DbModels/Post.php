<?php

namespace App\DbModels;

use Illuminate\Database\Eloquent\Model;

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
        'createdByUserId', 'propertyId', 'createdUserId', 'deletedUserId', 'type', 'status', 'likeCount', 'likeUsers', 'attachment'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attachment' => 'boolean',
    ];

    /**
     * get the property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function property()
    {
        return $this->hasOne(Property::class, 'id', 'propertyId');
    }

    /**
     * get the details based on type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'resourceId')->where('type', Attachment::ATTACHMENT_TYPE_POST);
    }
}
