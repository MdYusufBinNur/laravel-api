<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;

class FdiLogResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response =  [
            'id' => $this->id,
            'fdiId' => $this->fdiId,
            'userId' => $this->userId,
            'text' => $this->text,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        $additionalMessage = $this->buildMessage();

        return array_merge($response, $additionalMessage);
    }

    private function buildMessage()
    {
        $message = [];

        $message['readable'] = Str::title($this->text) . ' by ' . $this->user->name;

        return $message;
    }
}
