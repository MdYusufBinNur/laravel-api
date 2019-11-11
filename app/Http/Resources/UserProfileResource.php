<?php

namespace App\Http\Resources;

class UserProfileResource extends Resource
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
            'createdByUserId' => $this->createdByUserId,
            'userId' => $this->userId,
            'gender' => $this->gender,
            'occupation' => $this->occupation,
            'homeTown' => $this->homeTown,
            'birthDate' => $this->birthDate,
            'language' => $this->language,
            'website' => $this->website,
            'facebookUsername' => $this->facebookUsername,
            'twitterUsername' => $this->twitterUsername,
            'aboutMe' => $this->aboutMe,
            'interests' => $this->interests,
            'userProfileLinks' => $this->when($this->needToInclude($request, 'userProfile.userProfileLinks'), function () {
                return new UserProfileLinkResourceCollection($this->userProfileLinks);
            }),
            'userProfileChildren' => $this->when($this->needToInclude($request, 'userProfile.userProfileChildren'), function () {
                return new UserProfileChildResourceCollection($this->userProfileChildren);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
