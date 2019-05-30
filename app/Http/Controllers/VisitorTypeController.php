<?php

namespace App\Http\Controllers;

use App\DbModels\VisitorType;
use App\Http\Requests\VisitorType\IndexRequest;
use App\Http\Requests\VisitorType\StoreRequest;
use App\Http\Requests\VisitorType\UpdateRequest;
use App\Http\Resources\VisitorTypeResource;
use App\Http\Resources\VisitorTypeResourceCollection;
use App\Repositories\Contracts\VisitorTypeRepository;
use Illuminate\Http\Request;

class VisitorTypeController extends Controller
{
    /**
     * @var VisitorTypeRepository
     */
    protected $visitorTypeRepository;

    /**
     * VisitorTypeController constructor.
     * @param VisitorTypeRepository $visitorTypeRepository
     */
    public function __construct(VisitorTypeRepository $visitorTypeRepository)
    {
        $this->visitorTypeRepository = $visitorTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return VisitorTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $visitorTypes = $this->visitorTypeRepository->findBy($request->all());

        return new VisitorTypeResourceCollection($visitorTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return VisitorTypeResource
     */
    public function store(StoreRequest $request)
    {
        $visitorType = $this->visitorTypeRepository->save($request->all());

        return new VisitorTypeResource($visitorType);
    }

    /**
     * Display the specified resource.
     *
     * @param VisitorType $visitorType
     * @return VisitorTypeResource
     */
    public function show(VisitorType $visitorType)
    {
        return new VisitorTypeResource($visitorType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param VisitorType $visitorType
     * @return VisitorTypeResource
     */
    public function update(UpdateRequest $request, VisitorType $visitorType)
    {
        $visitorType = $this->visitorTypeRepository->update($visitorType,$request->all());

        return new VisitorTypeResource($visitorType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VisitorType $visitorType
     * @return void
     */
    public function destroy(VisitorType $visitorType)
    {
        $this->visitorTypeRepository->delete($visitorType);

        return response()->json(null,204);
    }
}
