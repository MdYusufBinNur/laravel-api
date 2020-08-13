<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Requests\Reporting\Package\ReportRequest;
use App\Http\Resources\Reporting\PackageResourceCollection;
use App\Services\Reporting\Package;
use App\Http\Controllers\Controller;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReportRequest $request
     * @return PackageResourceCollection
     */
    public function index(ReportRequest $request)
    {
        $packages = Package::packageReports($request->all());

        return new PackageResourceCollection($packages);
    }
}
