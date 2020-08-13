<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\ServiceRequest\ReportRequest;
use App\Http\Resources\Reporting\ServiceRequestResourceCollection;
use App\Services\Reporting\ServiceRequest;
use App\Http\Controllers\Controller;

class ServiceRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return ServiceRequestResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $serviceRequests = ServiceRequest::serviceRequestsReports($request->all());

        return new ServiceRequestResourceCollection($serviceRequests);
    }
}
