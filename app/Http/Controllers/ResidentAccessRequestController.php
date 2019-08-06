<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentAccessRequest;
use App\Http\Requests\ResidentAccessRequest\IndexRequest;
use App\Http\Requests\ResidentAccessRequest\StoreRequest;
use App\Http\Requests\ResidentAccessRequest\UpdateRequest;
use App\Http\Resources\ResidentAccessRequestResource;
use App\Http\Resources\ResidentAccessRequestResourceCollection;
use App\Repositories\Contracts\ResidentAccessRequestRepository;
use Illuminate\Http\Request;

class ResidentAccessRequestController extends Controller
{
    /**
     * @var ResidentAccessRequestRepository
     */
    protected $residentAccessRequestRepository;

    /**
     * ResidentAccessRequestController constructor.
     * @param ResidentAccessRequestRepository $residentAccessRequestRepository
     */
    public function __construct(ResidentAccessRequestRepository $residentAccessRequestRepository)
    {
        $this->residentAccessRequestRepository = $residentAccessRequestRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentAccessRequestResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residentAccessRequests = $this->residentAccessRequestRepository->findBy($request->all());

        return new ResidentAccessRequestResourceCollection($residentAccessRequests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ResidentAccessRequestResource
     */
    public function store(StoreRequest $request)
    {
        $residentAccessRequest = $this->residentAccessRequestRepository->save($request->all());

        return new ResidentAccessRequestResource($residentAccessRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return ResidentAccessRequestResource
     */
    public function show(Request $request)
    {
        $residentAccessRequest = $this->residentAccessRequestRepository->findOneBy(['email' => $request['email'], 'pin' => $request['pin']]);

        if (!$residentAccessRequest instanceof ResidentAccessRequest) {
            return response()->json(['status' => 404, 'message' => 'Incorrect pin!!'], 404);
        }

        return new ResidentAccessRequestResource($residentAccessRequest);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentAccessRequest $residentAccessRequest
     * @return ResidentAccessRequestResource
     */
    public function update(UpdateRequest $request, ResidentAccessRequest $residentAccessRequest)
    {
        $residentAccessRequest = $this->residentAccessRequestRepository->update($residentAccessRequest, $request->all());

        return new ResidentAccessRequestResource($residentAccessRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentAccessRequest $residentAccessRequest
     * @return void
     */
    public function destroy(ResidentAccessRequest $residentAccessRequest)
    {
        $this->residentAccessRequestRepository->delete($residentAccessRequest);
    }
}
