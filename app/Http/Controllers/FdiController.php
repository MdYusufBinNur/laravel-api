<?php

namespace App\Http\Controllers;

use App\DbModels\Fdi;
use App\Http\Requests\Fdi\IndexRequest;
use App\Http\Requests\Fdi\StoreRequest;
use App\Http\Requests\Fdi\UpdateRequest;
use App\Http\Resources\FdiResource;
use App\Http\Resources\FdiResourceCollection;
use App\Repositories\Contracts\FdiRepository;

class FdiController extends Controller
{
    /**
     * @var FdiRepository
     */
    protected $fdiRepository;

    /**
     * FdiController constructor.
     * @param FdiRepository $fdiRepository
     */
    public function __construct(FdiRepository $fdiRepository)
    {
        $this->fdiRepository = $fdiRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return FdiResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $fdis = $this->fdiRepository->findBy($request->all());

        return new FdiResourceCollection($fdis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FdiResource
     */
    public function store(StoreRequest $request)
    {
        $fdi = $this->fdiRepository->save($request->all());

        return new FdiResource($fdi);
    }

    /**
     * Display the specified resource.
     *
     * @param Fdi $fdi
     * @return FdiResource
     */
    public function show(Fdi $fdi)
    {
        return new FdiResource($fdi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Fdi $fdi
     * @return FdiResource
     */
    public function update(UpdateRequest $request, Fdi $fdi)
    {
        $fdi = $this->fdiRepository->update($fdi, $request->all());

        return new FdiResource($fdi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fdi $fdi
     * @return void
     */
    public function destroy(Fdi $fdi)
    {
        $this->fdiRepository->deleteFdi($fdi);

        return response()->json(null, 204);
    }
}
