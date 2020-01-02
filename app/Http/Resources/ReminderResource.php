<?php

namespace App\Http\Resources;


class ReminderResource extends Resource
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
            'toUserIds' => $this->toUserIds,
            'toUnitIds' => $this->toUnitIds,
            'reminderType' => $this->reminderType,
            'resourceType' => $this->resourceType,
            'resourceId' => $this->resourceId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
