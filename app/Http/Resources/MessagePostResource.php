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
            'message' => $this->when($this->needToInclude($request, 'mp.message'), function () {
                return new MessageResource($this->message);
            }),
            'fromUserId' => $this->fromUserId,
            'fromUser' => $this->when($this->needToInclude($request, 'mp.fromUser'), function () {
                return new UserResource($this->fromUser);
            }),
            'text' => $this->text,
        ];
    }
}
