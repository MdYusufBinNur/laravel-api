<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyDesignSetting;
use App\Http\Requests\PropertyDesignSetting\IndexRequest;
use App\Http\Requests\PropertyDesignSetting\StoreRequest;
use App\Http\Requests\PropertyDesignSetting\UpdateRequest;
use App\Http\Resources\PropertyDesignSettingResource;
use App\Http\Resources\PropertyDesignSettingResourceCollection;
use App\Repositories\Contracts\PropertyDesignSettingRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PropertyDesignSettingController extends Controller
{
    /**
     * @var PropertyDesignSettingRepository
     */
    protected $propertyDesignSettingRepository;

    /**
     * PropertyDesignSettingController constructor.
     * @param PropertyDesignSettingRepository $propertyDesignSettingRepository
     */
    public function __construct(PropertyDesignSettingRepository $propertyDesignSettingRepository)
    {
        $this->propertyDesignSettingRepository = $propertyDesignSettingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PropertyDesignSettingResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', PropertyDesignSettingResource::class);

        $propertyDesignSettings = $this->propertyDesignSettingRepository->findBy($request->all());

        return new PropertyDesignSettingResourceCollection($propertyDesignSettings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PropertyDesignSettingResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PropertyDesignSettingResource::class, $request->input('propertyId')]);

        $propertyDesignSetting = $this->propertyDesignSettingRepository->setDesignSetting($request->all());

        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return PropertyDesignSettingResource
     * @throws AuthorizationException
     */
    public function show(PropertyDesignSetting $propertyDesignSetting)
    {
        $this->authorize('show', $propertyDesignSetting);

        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return PropertyDesignSettingResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PropertyDesignSetting $propertyDesignSetting)
    {
        $this->authorize('update', $propertyDesignSetting);

        $propertyDesignSetting = $this->propertyDesignSettingRepository->update($propertyDesignSetting,$request->all());

        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PropertyDesignSetting $propertyDesignSetting)
    {
        $this->authorize('destroy', $propertyDesignSetting);

        $this->propertyDesignSettingRepository->delete($propertyDesignSetting);

        return response()->json(null, 204);
    }
}
