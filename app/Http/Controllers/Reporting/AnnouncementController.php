<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\Announcement\ReportRequest;
use App\Http\Resources\Reporting\AnnouncementStateResource;
use App\Services\Reporting\Announcement;
use App\Http\Controllers\Controller;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return AnnouncementStateResource
     */
    public function announcementState(ReportRequest $request)
    {
        $stateData = Announcement::announcementState($request->all());

        return new AnnouncementStateResource($stateData);
    }
}
