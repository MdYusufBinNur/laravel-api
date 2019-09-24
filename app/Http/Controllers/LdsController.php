<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lds\PackagesRequest;
use App\Http\Resources\LdsSettingResourceCollection;
use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageResourceCollection;
use App\Repositories\Contracts\PackageRepository;

class LdsController extends Controller
{
    /**
     * @var PackageRepository
     */
    protected $packageRepository;

    /**
     * LdsSettingController constructor.
     * @param PackageRepository $packageRepository
     */
    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param PackagesRequest $request
     * @return LdsSettingResourceCollection
     */
    public function packages(PackagesRequest $request)
    {
        $ldsPackages = $this->packageRepository->getPackagesForLds($request->all());

        return new PackageResourceCollection($ldsPackages);
    }
}
