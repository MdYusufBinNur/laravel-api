<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\ResidentAccessRequest\ReportRequest;
use App\Http\Resources\Reporting\ResidentAccessRequestStateResource;
use App\Services\Reporting\ResidentAccessRequest;
use App\Http\Controllers\Controller;

class ResidentAccessRequestController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ResidentAccessRequestStateResource
     */
    public function residentAccessRequestState(ReportRequest $request)
    {
        $stateData = ResidentAccessRequest::residentAccessRequestState($request->all());

        return new ResidentAccessRequestStateResource($stateData);
    }
}
