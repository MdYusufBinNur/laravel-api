<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResidentAccessRequest\IndexRequest;
use App\Http\Requests\ResidentAccessRequest\StoreRequest;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
