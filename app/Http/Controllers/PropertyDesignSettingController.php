<?php

namespace App\Http\Controllers;

use App\DbModels\PropertyDesignSetting;
use App\Http\Requests\PropertyDesignSetting\IndexRequest;
use App\Http\Requests\PropertyDesignSetting\StoreRequest;
use App\Http\Requests\PropertyDesignSetting\UpdateRequest;
use App\Http\Resources\PropertyDesignSettingResource;
use App\Http\Resources\PropertyDesignSettingResourceCollection;
use App\Repositories\Contracts\PropertyDesignSettingRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $propertyDesignSettings = $this->propertyDesignSettingRepository->findBy($request->all());

        return new PropertyDesignSettingResourceCollection($propertyDesignSettings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PropertyDesignSettingResource
     */
    public function store(StoreRequest $request)
    {
        $propertyDesignSetting = $this->propertyDesignSettingRepository->save($request->all());

        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Display the specified resource.
     *
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return PropertyDesignSettingResource
     */
    public function show(PropertyDesignSetting $propertyDesignSetting)
    {
        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return PropertyDesignSettingResource
     */
    public function update(UpdateRequest $request, PropertyDesignSetting $propertyDesignSetting)
    {
        $propertyDesignSetting = $this->propertyDesignSettingRepository->update($propertyDesignSetting,$request->all());

        return new PropertyDesignSettingResource($propertyDesignSetting);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PropertyDesignSetting $propertyDesignSetting
     * @return void
     */
    public function destroy(PropertyDesignSetting $propertyDesignSetting)
    {
        $this->propertyDesignSettingRepository->delete($propertyDesignSetting);

        return response()->json(null, 204);
    }
}
