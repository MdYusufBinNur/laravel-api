<?php

namespace App\Http\Resources;


class MessagePostResource extends Resource
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
            'messageId' => $this->messageId,
            'fromUserId' => $this->fromUserId,
            'text' => $this->text,
        ];
    }
}
