<?php

namespace App\Http\Controllers;

use App\DbModels\FdiLog;
use App\Http\Requests\FdiLog\IndexRequest;
use App\Http\Requests\FdiLog\UpdateRequest;
use App\Http\Resources\FdiLogResource;
use App\Http\Resources\FdiLogResourceCollection;
use App\Repositories\Contracts\FdiLogRepository;
use Illuminate\Http\Request;

class FdiLogController extends Controller
{
    /**
     * @var FdiLogRepository
     */
    protected $fdiLogRepository;

    /**
     * FdiLogController constructor.
     * @param FdiLogRepository $fdiLogRepository
     */
    public function __construct(FdiLogRepository $fdiLogRepository)
    {
        $this->fdiLogRepository = $fdiLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return FdiLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $fdiLogs = $this->fdiLogRepository->findBy($request->all());

        return new FdiLogResourceCollection($fdiLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FdiLogResource
     */
    public function store(Request $request)
    {
        $fdiLog = $this->fdiLogRepository->save($request->all());

        return new FdiLogResource($fdiLog);
    }

    /**
     * Display the specified resource.
     *
     * @param FdiLog $fdiLog
     * @return FdiLogResource
     */
    public function show(FdiLog $fdiLog)
    {
        return new FdiLogResource($fdiLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param FdiLog $fdiLog
     * @return FdiLogResource
     */
    public function update(UpdateRequest $request, FdiLog $fdiLog)
    {
        $fdiLog = $this->fdiLogRepository->update($fdiLog, $request->all());

        return new FdiLogResource($fdiLog);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FdiLog $fdiLog
     * @return void
     */
    public function destroy(FdiLog $fdiLog)
    {
        $this->fdiLogRepository->delete($fdiLog);

        return response()->json(null, 204);
    }
}
