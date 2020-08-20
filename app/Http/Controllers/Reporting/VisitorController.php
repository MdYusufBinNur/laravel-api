<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\Visitor\ReportRequest;
use App\Http\Resources\Reporting\VisitorStateResource;
use App\Services\Reporting\Visitor;
use App\Http\Controllers\Controller;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return VisitorStateResource
     */
    public function index(ReportRequest $request)
    {
        $stateData = Visitor::visitorState($request->all());

        return new VisitorStateResource($stateData);
    }
}
