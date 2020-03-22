<?php

namespace App\Http\Controllers;

use App\DbModels\LdsSetting;
use App\Http\Requests\LdsSetting\IndexRequest;
use App\Http\Requests\LdsSetting\StoreRequest;
use App\Http\Requests\LdsSetting\UpdateRequest;
use App\Http\Resources\LdsSettingResource;
use App\Http\Resources\LdsSettingResourceCollection;
use App\Repositories\Contracts\LdsSettingRepository;
use Illuminate\Auth\Access\AuthorizationException;

class LdsSettingController extends Controller
{
    /**
     * @var LdsSettingRepository
     */
    protected $ldsSettingRepository;

    /**
     * LdsSettingController constructor.
     * @param LdsSettingRepository $ldsSettingRepository
     */
    public function __construct(LdsSettingRepository $ldsSettingRepository)
    {
        $this->ldsSettingRepository = $ldsSettingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return LdsSettingResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [LdsSetting::class, $request->input('propertyId')]);

        $ldsSetting = $this->ldsSettingRepository->findBy($request->all());

        return new LdsSettingResourceCollection($ldsSetting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return LdsSettingResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [LdsSetting::class, $request->input('propertyId')]);

        $ldsSetting = $this->ldsSettingRepository->saveLdsSetting($request->all());

        return new LdsSettingResource($ldsSetting);
    }

    /**
     * Display the specified resource.
     *
     * @param LdsSetting $ldsSetting
     * @return LdsSettingResource
     * @throws AuthorizationException
     */
    public function show(LdsSetting $ldsSetting)
    {
        $this->authorize('show', $ldsSetting);

        return new LdsSettingResource($ldsSetting);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param LdsSetting $ldsSetting
     * @return LdsSettingResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, LdsSetting $ldsSetting)
    {
        $this->authorize('update', $ldsSetting);

        $ldsSetting = $this->ldsSettingRepository->update($ldsSetting, $request->all());

        return new LdsSettingResource($ldsSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LdsSetting $ldsSetting
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(LdsSetting $ldsSetting)
    {
        $this->authorize('destroy', $ldsSetting);

        $this->ldsSettingRepository->delete($ldsSetting);

        return response()->json(null, 204);
    }
}
