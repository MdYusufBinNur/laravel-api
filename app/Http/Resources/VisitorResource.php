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
            'property' => $this->when($this->needToInclude($request, 'visitor.property'), function () {
                return new PropertyResource($this->property);
            }),
            'signInUserId' => $this->signInUserId,
            'signInUser' => $this->when($this->needToInclude($request, 'visitor.signInUser'), function () {
                return new UserResource($this->signInUser);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'visitor.unit'), function () {
                return new UnitResource($this->visitorType);
            }),
            'visitorTypeId' => $this->visitorTypeId,
            'visitorType' => $this->when($this->needToInclude($request, 'visitor.visitorType'), function () {
                return new VisitorTypeResource($this->visitorType);
            }),
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'company' => $this->company,
            'image' => $this->when($this->needToInclude($request, 'visitor.photo'), function () {
                return new AttachmentResource($this->image);
            }),
            'permanent' => $this->permanent,
            'comment' => $this->comment,
            'signature' => $this->signature,
            'status' => $this->status,
            'signInAt' => $this->signInAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
