<?php

namespace App\Http\Resources;

use App\DbModels\FdiGuestType;

class FdiResource extends Resource
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
            'id' => $this->getIdOrUuid(),
            'propertyId' => $this->propertyId,
            'property' => $this->when($this->needToInclude($request, 'fdi.property'), function () {
                return new UnitResource($this->property);
            }),
            'createdByUserId' => $this->createdByUserId,
            'createdByUser' => $this->when($this->needToInclude($request, 'fdi.createdByUser'), function () {
                return new UserResource($this->createdByUser);
            }),
            'unitId' => $this->unitId,
            'unit' => $this->when($this->needToInclude($request, 'fdi.unit'), function () {
                return new UnitResource($this->unit);
            }),
            'type' => $this->type,
            'name' => $this->name,
            'guestTypeId' => $this->guestTypeId,
            'guestType' => $this->when($this->needToInclude($request, 'fdi.guestType'), function () {
                return new FdiGuestTypeResource($this->guestType);
            }),
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'permanent' => $this->permanent,
            'comment' => $this->comment,
            'canGetKey' => $this->canGetKey,
            'signature' => $this->signature,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'logs' => $this->when($this->needToInclude($request, 'fdi.logs'), function () {
                return new FdiLogResourceCollection($this->logs);
            }),
            'images' => $this->when($this->needToInclude($request, 'fdi.images'), function () {
                return new AttachmentResourceCollection($this->fdiImages);
            }),
        ];
    }
}
