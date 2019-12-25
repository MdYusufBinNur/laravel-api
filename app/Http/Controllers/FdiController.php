<?php

namespace App\Http\Controllers;

use App\DbModels\Fdi;
use App\Http\Requests\Fdi\IndexRequest;
use App\Http\Requests\Fdi\StoreRequest;
use App\Http\Requests\Fdi\UpdateRequest;
use App\Http\Resources\FdiResource;
use App\Http\Resources\FdiResourceCollection;
use App\Repositories\Contracts\FdiRepository;
use Illuminate\Auth\Access\AuthorizationException;

class FdiController extends Controller
{
    /**
     * @var FdiRepository
     */
    protected $fdiRepository;

    /**
     * FdiController constructor.
     * @param FdiRepository $fdiRepository
     *
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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Fdi::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $fdis = $this->fdiRepository->findBy($request->all());

        return new FdiResourceCollection($fdis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FdiResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Fdi::class, $request->get('propertyId'), $request->get('unitId', null)]);

        $fdi = $this->fdiRepository->save($request->all());

        return new FdiResource($fdi);
    }

    /**
     * Display the specified resource.
     *
     * @param Fdi $fdi
     * @return FdiResource
     * @throws AuthorizationException
     */
    public function show(Fdi $fdi)
    {
        $this->authorize('show', $fdi);

        return new FdiResource($fdi);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Fdi $fdi
     * @return FdiResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Fdi $fdi)
    {
        $this->authorize('update', $fdi);

        $fdi = $this->fdiRepository->update($fdi, $request->all());

        return new FdiResource($fdi);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Fdi $fdi
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Fdi $fdi)
    {
        $this->authorize('destroy', $fdi);

        $this->fdiRepository->deleteFdi($fdi);

        return response()->json(null, 204);
    }
}
