<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class AnnouncementStateResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'total' => $this->total,
            'showOnWebsite' => $this->showOnWebsite,
            'showOnLds' => $this->showOnLds,
            'active' => $this->active,
            'expired' => $this->expired,
        ];
    }
}
