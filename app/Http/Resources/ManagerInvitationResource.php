<?php

namespace App\Http\Resources;

class ManagerInvitationResource extends Resource
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
            'id'                => $this->id,
            'propertyId'        => $this->propertyId,
            'email'             => $this->email,
            'name'              => $this->name,
            'title'             => $this->title,
            'level'             => $this->level,
            'status'            => $this->status,
            'pin'               => $this->pin,
            'invitedAt'         => $this->invitedAt,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
