<?php

namespace App\Http\Controllers;

use App\DbModels\NotificationTemplate;
use App\Http\Requests\NotificationTemplate\IndexRequest;
use App\Http\Requests\NotificationTemplate\StoreRequest;
use App\Http\Requests\NotificationTemplate\UpdateRequest;
use App\Http\Resources\NotificationTemplateResource;
use App\Http\Resources\NotificationTemplateResourceCollection;
use App\Repositories\Contracts\NotificationTemplateRepository;

class NotificationTemplateController extends Controller
{
    /**
     * @var NotificationTemplateRepository
     */
    protected $notificationTemplateRepository;

    /**
     * NotificationTemplateController constructor.
     * @param NotificationTemplateRepository $notificationTemplateRepository
     */
    public function __construct(NotificationTemplateRepository $notificationTemplateRepository)
    {
        $this->notificationTemplateRepository = $notificationTemplateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return NotificationTemplateResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $notificationTemplates = $this->notificationTemplateRepository->findBy(($request->all()));

        return new NotificationTemplateResourceCollection($notificationTemplates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return NotificationTemplateResource
     */
    public function store(StoreRequest $request)
    {
        $notificationTemplate = $this->notificationTemplateRepository->save($request->all());

        return new NotificationTemplateResource($notificationTemplate);
    }

    /**
     * Display the specified resource.
     *
     * @param NotificationTemplate $notificationTemplate
     * @return NotificationTemplateResource
     */
    public function show(NotificationTemplate $notificationTemplate)
    {
        return new NotificationTemplateResource($notificationTemplate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param NotificationTemplate $notificationTemplate
     * @return NotificationTemplateResource
     */
    public function update(UpdateRequest $request, NotificationTemplate $notificationTemplate)
    {
        $notificationTemplate = $this->notificationTemplateRepository->update($notificationTemplate, $request->all());

        return new NotificationTemplateResource($notificationTemplate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param NotificationTemplate $notificationTemplate
     * @return void
     */
    public function destroy(NotificationTemplate $notificationTemplate)
    {
        $this->notificationTemplateRepository->delete($notificationTemplate);

        return response()->json(null ,204);
    }
}
