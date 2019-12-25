<?php

namespace App\Http\Resources;

class UserLoginResource extends Resource
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
            'locale' => $this->locale,
            'isActive' => $this->isActive,
            'roles' => $this->when($this->needToInclude($request, 'ul.roles'), function () {
                return new UserRoleResourceCollection($this->userRoles);
            }),
            'residents' => $this->when($this->needToInclude($request, 'ul.residents'), function () {
                return new ResidentResourceCollection($this->residents);
            }),
            'staffs' => $this->when($this->needToInclude($request, 'ul.staffs'), function () {
                return new StaffResourceCollection($this->managers);
            }),
            'enterpriseUser' => $this->when($this->needToInclude($request, 'ul.enterpriseUser'), function () {
                return new EnterpriseUserResource($this->enterpriseUser);
            }),
            'admin' => $this->when($this->needToInclude($request, 'ul.admin'), function () {
                return new AdminResource($this->admin);
            }),
            'profilePic' => $this->when($this->needToInclude($request, 'ul.profilePic'), function () {
                return new AttachmentResource($this->userProfilePics->last());
            }),
            'lastLoginAt' => $this->lastLoginAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
