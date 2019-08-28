<?php

namespace App\Http\Controllers;

use App\DbModels\NotificationTemplateType;
use App\Http\Requests\NotificationTemplateType\IndexRequest;
use App\Http\Requests\NotificationTemplateType\StoreRequest;
use App\Http\Requests\NotificationTemplateType\UpdateRequest;
use App\Http\Resources\NotificationTemplateTypeResource;
use App\Http\Resources\NotificationTemplateTypeResourceCollection;
use App\Repositories\Contracts\NotificationTemplateTypeRepository;

class NotificationTemplateTypeController extends Controller
{
    /**
     * @var NotificationTemplateTypeRepository
     */
    protected $notificationTemplateTypeRepository;

    /**
     * NotificationTemplateTypeController constructor.
     * @param NotificationTemplateTypeRepository $notificationTemplateTypeRepository
     */
    public function __construct(NotificationTemplateTypeRepository $notificationTemplateTypeRepository)
    {
        $this->notificationTemplateTypeRepository = $notificationTemplateTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return NotificationTemplateTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $notificationTemplates = $this->notificationTemplateTypeRepository->findBy(($request->all()));

        return new NotificationTemplateTypeResourceCollection($notificationTemplates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return NotificationTemplateTypeResource
     */
    public function store(StoreRequest $request)
    {
        $notificationTemplate = $this->notificationTemplateTypeRepository->save($request->all());

        return new NotificationTemplateTypeResource($notificationTemplate);
    }

    /**
     * Display the specified resource.
     *
     * @param NotificationTemplateType $notificationTemplateType
     * @return NotificationTemplateTypeResource
     */
    public function show(NotificationTemplateType $notificationTemplateType)
    {
        return new NotificationTemplateTypeResource($notificationTemplateType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param NotificationTemplateType $notificationTemplateType
     * @return NotificationTemplateTypeResource
     */
    public function update(UpdateRequest $request, NotificationTemplateType $notificationTemplateType)
    {
        $notificationTemplateType = $this->notificationTemplateTypeRepository->update($notificationTemplateType, $request->all());

        return new NotificationTemplateTypeResource($notificationTemplateType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NotificationTemplateType $notificationTemplateType
     * @return void
     */
    public function destroy(NotificationTemplateType $notificationTemplateType)
    {
        $this->notificationTemplateTypeRepository->delete($notificationTemplateType);

        return response()->json(null ,204);
    }
}
