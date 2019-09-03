<?php

namespace App\Http\Resources;


class NotificationTemplateResource extends Resource
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
            'typeId' => $this->typeId,
            'title' => $this->title,
            'text' => $this->text,
            'editable' => $this->editable,
        ];
    }
}