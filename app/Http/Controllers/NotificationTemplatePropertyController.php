<?php

namespace App\Http\Controllers;


use App\DbModels\NotificationTemplateProperty;
use App\Http\Requests\NotificationTemplateProperty\IndexRequest;
use App\Http\Requests\NotificationTemplateProperty\StoreRequest;
use App\Http\Requests\NotificationTemplateProperty\UpdateRequest;
use App\Http\Resources\NotificationTemplatePropertyResource;
use App\Http\Resources\NotificationTemplatePropertyResourceCollection;
use App\Repositories\Contracts\NotificationTemplatePropertyRepository;

class NotificationTemplatePropertyController extends Controller
{
    /**
     * @var NotificationTemplatePropertyRepository
     */
    protected $notificationTemplatePropertyRepository;

    /**
     * NotificationTemplatePropertyController constructor.
     * @param NotificationTemplatePropertyRepository $notificationTemplatePropertyRepository
     */
    public function __construct(NotificationTemplatePropertyRepository $notificationTemplatePropertyRepository)
    {
        $this->notificationTemplatePropertyRepository = $notificationTemplatePropertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return NotificationTemplatePropertyResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $notificationPropertyTemplates = $this->notificationTemplatePropertyRepository->findBy(($request->all()));

        return new NotificationTemplatePropertyResourceCollection($notificationPropertyTemplates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return NotificationTemplatePropertyResource
     */
    public function store(StoreRequest $request)
    {
        $notificationTemplate = $this->notificationTemplatePropertyRepository->save($request->all());

        return new NotificationTemplatePropertyResource($notificationTemplate);
    }

    /**
     * Display the specified resource.
     *
     * @param NotificationTemplateProperty $notificationTemplateProperty
     * @return NotificationTemplatePropertyResource
     */
    public function show(NotificationTemplateProperty $notificationTemplateProperty)
    {
        return new NotificationTemplatePropertyResource($notificationTemplateProperty);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param NotificationTemplateProperty $notificationTemplateProperty
     * @return NotificationTemplatePropertyResource
     */
    public function update(UpdateRequest $request, NotificationTemplateProperty $notificationTemplateProperty)
    {
        $notificationTemplateProperty = $this->notificationTemplatePropertyRepository->update($notificationTemplateProperty, $request->all());

        return new NotificationTemplatePropertyResource($notificationTemplateProperty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NotificationTemplateProperty $notificationTemplateProperty
     * @return void
     */
    public function destroy(NotificationTemplateProperty $notificationTemplateProperty)
    {
        $this->notificationTemplatePropertyRepository->delete($notificationTemplateProperty);

        return response()->json(null ,204);
    }
}
