<?php

namespace App\Http\Resources;

use App\DbModels\Post;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'propertyId' =>  $this->propertyId,
            'createdByUserId' =>  $this->createdUserId,
            'createdByUser' =>  $this->when($this->needToInclude($request, 'post.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'property' => $this->when($this->needToInclude($request, 'post.property'), function () {
                return new PropertyResource($this->property);
            }),
            'deletedUserId' =>  $this->deletedUserId,
            'type' =>  $this->type,
            //todo very expensive operation
            'details' => $this->when($this->needToInclude($request, 'post.details'), function () {
                return $this->getResourceByType();
            }),
            'comments' => $this->when($this->needToInclude($request, 'post.comments'), function () {
                return new PostCommentResourceCollection($this->comments);
            }),
            'commentsCount' => $this->when($this->needToInclude($request, 'post.commentsCount'), function () {
                return $this->comments()->count();
            }),
            'status' =>  $this->status,
            'likeCount' =>  $this->likeCount,
            'likeUsers' =>  $this->likeUsers,
            'attachments' => $this->when($this->needToInclude($request, 'post.attachments'), function () {
                return new AttachmentResourceCollection($this->attachments);
            }),
            'approvalArchives' => $this->when($this->needToInclude($request, 'post.approvalArchives'), function () {
                return new PostApprovalArchiveResourceCollection($this->approvalArchives);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }

    private function getResourceByType()
    {
        $resource = null;
        switch ($this->type) {
            case Post::TYPE_WALL:
                $resource = new PostWallResourceCollection($this->detailByType);
                break;
            case Post::TYPE_EVENT:
                $resource = new PostEventResourceCollection($this->detailByType);
                break;
            case Post::TYPE_MARKETPLACE:
                $resource = new PostMarketPlaceResourceCollection($this->detailByType);
                break;
            case Post::TYPE_POLL:
                $resource = new PostPollResourceCollection($this->detailByType);
                break;
            case Post::TYPE_RECOMMENDATION:
                $resource = new PostRecommendationResourceCollection($this->detailByType);
                break;
        }

        return $resource;
    }
}
