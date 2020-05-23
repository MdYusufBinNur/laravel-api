<?php

namespace App\Http\Resources;


use App\DbModels\Reminder;

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
            'id' => $this->getIdOrUuid(),
            'createdByUserId' => $this->createdByUserId,
            'propertyId' => $this->propertyId,
            'toUserIds' => $this->toUserIds,
            'toUnitIds' => $this->toUnitIds,
            'reminderType' => $this->reminderType,
            'resourceType' => $this->resourceType,
            'resourceId' => $this->resourceId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'details' => $this->detailByType
        ];
    }
}
