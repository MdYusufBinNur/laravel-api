<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lds\PackagesRequest;
use App\Http\Resources\AnnouncementResourceCollection;
use App\Http\Resources\PackageResourceCollection;
use App\Repositories\Contracts\AnnouncementRepository;
use App\Repositories\Contracts\PackageRepository;

class LdsController extends Controller
{
    /**
     * @var PackageRepository
     */
    protected $packageRepository;

    /**
     * @var AnnouncementRepository
     */
    protected $announcementRepository;

    /**
     * LdsSettingController constructor.
     * @param PackageRepository $packageRepository
     * @param AnnouncementRepository $announcementRepository
     */
    public function __construct(PackageRepository $packageRepository, AnnouncementRepository $announcementRepository)
    {
        $this->packageRepository = $packageRepository;
        $this->announcementRepository = $announcementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param PackagesRequest $request
     * @return PackageResourceCollection
     */
    public function packages(PackagesRequest $request)
    {
        $packages = $this->packageRepository->getPackagesForLds($request->all());
        return new PackageResourceCollection($packages);
    }

    /**
     * Display a listing of the resource.
     *
     * @param PackagesRequest $request
     * @return AnnouncementResourceCollection
     */
    public function announcements(PackagesRequest $request)
    {
        $announcements = $this->announcementRepository->getAnnouncementsForLds($request->all());
        return new AnnouncementResourceCollection($announcements);
    }
}
