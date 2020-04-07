<?php

namespace App\Http\Resources;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'locale' => $this->locale,
            'isActive' => $this->isActive,
            'roles' => $this->when($this->needToInclude($request, 'user.roles'), function () {
                return new UserRoleResourceCollection($this->userRoles);
            }),
            'residents' => $this->when($this->needToInclude($request, 'user.residents'), function () {
                return new ResidentResourceCollection($this->residents);
            }),
            'staffs' => $this->when($this->needToInclude($request, 'user.staffs'), function () {
                return new StaffResourceCollection($this->managers);
            }),
            'enterpriseUser' => $this->when($this->needToInclude($request, 'user.enterpriseUser'), function () {
                return new EnterpriseUserResource($this->enterpriseUser);
            }),
            'profilePic' => $this->when($this->needToInclude($request, 'user.profilePic'), function () {
                return new AttachmentResource($this->userProfilePics->last());
            }),
            'userProfile' => $this->when($this->needToInclude($request, 'user.userProfile'), function () {
                return new UserProfileResource($this->userProfile);
            }),
            //'userLabel' => $this->userLabel, @draft
            'lastLoginAt' => $this->lastLoginAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
