<?php

namespace App\Http\Controllers;

use App\DbModels\StaffTimeClock;
use App\Http\Requests\WebhookStaffTimeClock\StoreRequest;
use App\Http\Resources\StaffTimeClockResource;
use App\Repositories\Contracts\StaffTimeClockRepository;
use Illuminate\Auth\Access\AuthorizationException;

class WebhookStaffTimeClockController extends Controller
{
    /**
     * @var StaffTimeClockRepository
     */
    protected $staffTimeClockRepository;

    /**
     * StaffTimeClockController constructor.
     * @param StaffTimeClockRepository $staffTimeClockRepository
     */
    public function __construct(StaffTimeClockRepository $staffTimeClockRepository)
    {
        $this->staffTimeClockRepository = $staffTimeClockRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return StaffTimeClockResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $staffTimeClock = $this->staffTimeClockRepository->saveFromWebhook($request->all());

        return new StaffTimeClockResource($staffTimeClock);
    }
}
