<?php

namespace App\Http\Resources;

class VisitorResource extends Resource
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
            'propertyId' => $this->propertyId,
            'signinUserId' => $this->signinUserId,
            'unitId' => $this->unitId,
            'visitorTypeId' => $this->visitorTypeId,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'company' => $this->company,
            'photo' => $this->photo,
            'permanent' => $this->permanent,
            'comment' => $this->comment,
            'signature' => $this->signature,
            'status' => $this->status,
            'signinAt' => $this->signinAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
