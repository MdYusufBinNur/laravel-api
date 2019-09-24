<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lds\AnnouncementsRequest;
use App\Http\Requests\Lds\EventsRequest;
use App\Http\Requests\Lds\PackagesRequest;
use App\Http\Resources\AnnouncementResourceCollection;
use App\Http\Resources\EventResourceCollection;
use App\Http\Resources\PackageResourceCollection;
use App\Repositories\Contracts\AnnouncementRepository;
use App\Repositories\Contracts\EventRepository;
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
     * @var EventRepository
     */
    protected $eventRepository;

    /**
     * LdsSettingController constructor.
     * @param PackageRepository $packageRepository
     * @param AnnouncementRepository $announcementRepository
     */
    public function __construct(PackageRepository $packageRepository, AnnouncementRepository $announcementRepository, EventRepository $eventRepository)
    {
        $this->packageRepository = $packageRepository;
        $this->announcementRepository = $announcementRepository;
        $this->eventRepository = $eventRepository;
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
     * @param AnnouncementsRequest $request
     * @return AnnouncementResourceCollection
     */
    public function announcements(AnnouncementsRequest $request)
    {
        $announcements = $this->announcementRepository->getAnnouncementsForLds($request->all());
        return new AnnouncementResourceCollection($announcements);
    }

    /**
     * Display a listing of the resource.
     *
     * @param EventsRequest $request
     * @return EventResourceCollection
     */
    public function events(EventsRequest $request)
    {
        $events = $this->eventRepository->getEventsForLds($request->all());
        return new EventResourceCollection($events);
    }
}
