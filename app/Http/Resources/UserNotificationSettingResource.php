<?php

namespace App\Http\Resources;

class UserNotificationSettingResource extends Resource
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
            'typeId' => $this->typeId,
            'propertyId' => $this->propertyId,
            'email' => $this->email,
            'sms' => $this->sms,
            'voice' => $this->voice,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
