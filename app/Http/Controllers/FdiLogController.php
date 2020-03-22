<?php

namespace App\Http\Controllers;

use App\DbModels\FdiLog;
use App\Http\Requests\FdiLog\IndexRequest;
use App\Http\Requests\FdiLog\UpdateRequest;
use App\Http\Resources\FdiLogResource;
use App\Http\Resources\FdiLogResourceCollection;
use App\Repositories\Contracts\FdiLogRepository;
use Illuminate\Auth\Access\AuthorizationException;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [FdiLog::class, $request->input('propertyId')]);

        $fdiLogs = $this->fdiLogRepository->findBy($request->all());

        return new FdiLogResourceCollection($fdiLogs);
    }

    /**
     * Display the specified resource.
     *
     * @param FdiLog $fdiLog
     * @return FdiLogResource
     * @throws AuthorizationException
     */
    public function show(FdiLog $fdiLog)
    {
        $this->authorize('show', $fdiLog);

        return new FdiLogResource($fdiLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param FdiLog $fdiLog
     * @return FdiLogResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, FdiLog $fdiLog)
    {
        $this->authorize('update', $fdiLog);

        $fdiLog = $this->fdiLogRepository->update($fdiLog, $request->all());

        return new FdiLogResource($fdiLog);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FdiLog $fdiLog
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(FdiLog $fdiLog)
    {
        $this->authorize('destroy', $fdiLog);

        $this->fdiLogRepository->delete($fdiLog);

        return response()->json(null, 204);
    }
}
