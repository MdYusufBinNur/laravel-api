<?php

namespace App\Http\Controllers;

use App\DbModels\Announcement;
use App\Http\Requests\Announcement\IndexRequest;
use App\Http\Requests\Announcement\StoreRequest;
use App\Http\Requests\Announcement\UpdateRequest;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\AnnouncementResourceCollection;
use App\Repositories\Contracts\AnnouncementRepository;
use Illuminate\Auth\Access\AuthorizationException;

class AnnouncementController extends Controller
{
    /**
     * @var AnnouncementRepository
     */
    protected $announcementRepository;

    /**
     * AnnouncementController constructor.
     * @param AnnouncementRepository $announcementRepository
     */
    public function __construct(AnnouncementRepository $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }

    /**
     * Display a listing of the Announcement resource.
     *
     * @param IndexRequest $request
     * @return AnnouncementResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', $request->get('propertyId'));

        if (strpos($request->getPathInfo(), 'property-login-page-announcements') !== false) {
            $request->merge(['showOnWebsite' => 1]);
        }

        $announcements = $this->announcementRepository->findBy($request->all());

        return new AnnouncementResourceCollection($announcements);
    }

    /**
     * Store a newly created Announcement resource in storage.
     *
     * @param  StoreRequest  $request
     * @return AnnouncementResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', $request->get('propertyId'));

        $announcement = $this->announcementRepository->save($request->all());

        return new AnnouncementResource($announcement);
    }

    /**
     * Display the specified Announcement resource.
     *
     * @param Announcement $announcement
     * @return AnnouncementResource
     * @throws AuthorizationException
     */
    public function show(Announcement $announcement)
    {
        $this->authorize('show', $announcement);

        return new AnnouncementResource($announcement);
    }

    /**
     * Update the specified Announcement resource in storage.
     *
     * @param UpdateRequest $request
     * @param Announcement $announcement
     * @return AnnouncementResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Announcement $announcement)
    {
        $this->authorize('update', $announcement);

        $announcement = $this->announcementRepository->update($announcement, $request->all());

        return new AnnouncementResource($announcement);
    }

    /**
     * Remove the specified Announcement resource from storage.
     *
     * @param Announcement $announcement
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Announcement $announcement)
    {
        $this->authorize('destroy', $announcement);

        $this->announcementRepository->delete($announcement);

        return response()->json(null, 204);
    }
}
