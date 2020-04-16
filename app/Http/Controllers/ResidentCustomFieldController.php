<?php

namespace App\Http\Controllers;

use App\DbModels\ResidentCustomField;
use App\Http\Requests\ResidentCustomField\IndexRequest;
use App\Http\Requests\ResidentCustomField\StoreRequest;
use App\Http\Requests\ResidentCustomField\UpdateRequest;
use App\Http\Resources\ResidentCustomFieldResource;
use App\Http\Resources\ResidentCustomFieldResourceCollection;
use App\Repositories\Contracts\ResidentCustomFieldRepository;

class ResidentCustomFieldController extends Controller
{
    /**
     * @var ResidentCustomFieldRepository
     */
    protected $residentCustomFieldRepository;

    /**
     * ResidentCustomFieldController constructor.
     * @param ResidentCustomFieldRepository $residentCustomFieldRepository
     */
    public  function __construct(ResidentCustomFieldRepository $residentCustomFieldRepository)
    {
        $this->residentCustomFieldRepository = $residentCustomFieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return ResidentCustomFieldResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $residentCustomFields = $this->residentCustomFieldRepository->findBy($request->all());

        return new ResidentCustomFieldResourceCollection($residentCustomFields);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ResidentCustomFieldResource
     */
    public function store(StoreRequest $request)
    {
        $residentCustomField = $this->residentCustomFieldRepository->save($request->all());

        return new ResidentCustomFieldResource($residentCustomField);
    }

    /**
     * Display the specified resource.
     *
     * @param ResidentCustomField $residentCustomField
     * @return ResidentCustomFieldResource
     */
    public function show(ResidentCustomField $residentCustomField)
    {
        return new ResidentCustomFieldResource($residentCustomField);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param ResidentCustomField $residentCustomField
     * @return ResidentCustomFieldResource
     */
    public function update(UpdateRequest $request, ResidentCustomField $residentCustomField)
    {
        $residentCustomField = $this->residentCustomFieldRepository->update($residentCustomField, $request->all());

        return new ResidentCustomFieldResource($residentCustomField);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ResidentCustomField $residentCustomField
     * @return void
     */
    public function destroy(ResidentCustomField $residentCustomField)
    {
        $this->residentCustomFieldRepository->delete($residentCustomField);

        return response()->json(null, 204);
    }
}
