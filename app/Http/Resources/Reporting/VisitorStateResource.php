<?php

namespace App\Http\Resources\Reporting;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class VisitorStateResource extends Resource
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
            'totalVisitorsToday' => $this->resource['totalVisitorsToday'],
            'totalVisitorsToUnitToday' => $this->resource['totalVisitorsToUnitToday'],
            'totalVisitorsToUserToday' => $this->resource['totalVisitorsToUserToday'],
            'totalVisitorsOfAWeek' => $this->resource['totalVisitorsOfAWeek'],
            'totalVisitorsToUnitOfAWeek' => $this->resource['totalVisitorsToUnitOfAWeek'],
            'totalVisitorsToUserOfAWeek' => $this->resource['totalVisitorsToUserOfAWeek'],
            'totalVisitorsOfAYear' => $this->resource['totalVisitorsOfAYear'],
            'totalVisitorsToUnitOfAYear' => $this->resource['totalVisitorsToUnitOfAYear'],
            'totalVisitorsToUserOfAYear' => $this->resource['totalVisitorsToUserOfAYear'],
            'totalVisitors' => $this->resource['totalVisitors'],
            'totalVisitorsToUnit' => $this->resource['totalVisitorsToUnit'],
            'totalVisitorsToUser' => $this->resource['totalVisitorsToUser'],
        ];
    }
}
