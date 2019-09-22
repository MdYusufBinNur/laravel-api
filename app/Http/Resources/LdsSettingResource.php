<?php

namespace App\Http\Resources;


class LdsSettingResource extends Resource
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
            'refreshRate' => $this->refreshRate,
            'showPackages' => $this->showPackages,
            'iconSize' => $this->iconSize,
            'iconColor' => $this->iconColor,
            'theme' => $this->theme,
        ];
    }
}
