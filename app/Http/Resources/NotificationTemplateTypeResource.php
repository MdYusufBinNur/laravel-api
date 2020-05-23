<?php

namespace App\Http\Resources;


class NotificationTemplateTypeResource extends Resource
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
            'key' => $this->key,
            'module' => $this->module,
        ];
    }
}
