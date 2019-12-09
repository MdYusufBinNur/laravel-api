<?php

namespace App\Http\Controllers;

use App\DbModels\Announcement;
use App\DbModels\Event;
use App\DbModels\Package;
use App\Http\Requests\Lds\AnnouncementsRequest;
use App\Http\Requests\Lds\EventsRequest;
use App\Http\Requests\Lds\PackagesRequest;
use App\Http\Resources\AnnouncementResourceCollection;
use App\Http\Resources\EventResourceCollection;
use App\Http\Resources\PackageResourceCollection;
use App\Repositories\Contracts\AnnouncementRepository;
use App\Repositories\Contracts\EventRepository;
use App\Repositories\Contracts\PackageRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function packages(PackagesRequest $request)
    {
        $this->authorize('packagesForLds', Package::class);

        $packages = $this->packageRepository->getPackagesForLds($request->all());
        return new PackageResourceCollection($packages);
    }

    /**
     * Display a listing of the resource.
     *
     * @param AnnouncementsRequest $request
     * @return AnnouncementResourceCollection
     * @throws AuthorizationException
     */
    public function announcements(AnnouncementsRequest $request)
    {
        $this->authorize('announcementsForLds', Announcement::class);

        $announcements = $this->announcementRepository->getAnnouncementsForLds($request->all());
        return new AnnouncementResourceCollection($announcements);
    }

    /**
     * Display a listing of the resource.
     *
     * @param EventsRequest $request
     * @return EventResourceCollection
     * @throws AuthorizationException
     */
    public function events(EventsRequest $request)
    {
        $this->authorize('eventsForLds', Event::class);

        $events = $this->eventRepository->getEventsForLds($request->all());
        return new EventResourceCollection($events);
    }
}
