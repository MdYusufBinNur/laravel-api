<?php

namespace App\Http\Resources;

class VisitorArchiveResource extends Resource
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
            'visitorId' => $this->visitorId,
            'signOutUserId' => $this->signOutUserId,
            'signature' => $this->signature,
            'signOutAt' => $this->signOutAt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
