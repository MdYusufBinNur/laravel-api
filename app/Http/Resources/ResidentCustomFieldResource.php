<?php

namespace App\Http\Resources;


class ResidentCustomFieldResource extends Resource
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
            'createdByUser' => $this->when($this->needToInclude($request, 'rcf.user'), function () {
                return new UserResource($this->createdByUser);
            }),
            'residentId' => $this->residentId,
            'resident' => $this->when($this->needToInclude($request, 'rcf.resident'), function () {
                return new ResidentResource($this->resident);
            }),
            'fieldName' => $this->fieldName,
            'fieldValue' => $this->fieldValue,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
