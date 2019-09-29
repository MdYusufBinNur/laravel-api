<?php

namespace App\Http\Resources;


class MessageResource extends Resource
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
            'propertyId' => $this->propertyId,
            'fromUserId' => $this->fromUserId,
            'toUserId' => $this->toUserId,
            'subject' => $this->subject,
            'isGroupMessage' => $this->isGroupMessage,
            'group' => $this->group,
            'groupNames' => $this->groupNames,
            'emailNotification' => $this->emailNotification,
            'smsNotification' => $this->smsNotification,
            'voiceNotification' => $this->voiceNotification,
        ];
    }
}
