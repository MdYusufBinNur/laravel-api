<?php

namespace App\Http\Controllers;

use App\DbModels\Tower;
use App\Http\Requests\Tower\IndexRequest;
use App\Http\Requests\Tower\StoreRequest;
use App\Http\Requests\Tower\UpdateRequest;
use App\Http\Resources\TowerResource;
use App\Http\Resources\TowerResourceCollection;
use App\Repositories\Contracts\TowerRepository;
use Illuminate\Auth\Access\AuthorizationException;

class TowerController extends Controller
{
    /**
     * @var TowerRepository
     */
    protected $towerRepository;

    /**
     * TowerController constructor.
     *
     * @param TowerRepository $towerRepository
     */
    public function __construct(TowerRepository $towerRepository)
    {
        $this->towerRepository = $towerRepository;
    }

    /**
     * Display a listing of the Tower resource.
     *
     * @param IndexRequest $request
     * @return TowerResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Tower::class, $request->get('propertyId')]);

        $towers = $this->towerRepository->findBy($request->all());

        return new TowerResourceCollection($towers);
    }

    /**
     * create a Tower
     *
     * @param  StoreRequest  $request
     * @return TowerResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Tower::class, $request->get('propertyId')]);

        $tower = $this->towerRepository->save($request->all());

        return new TowerResource($tower);
    }

    /**
     * Display the specified Tower resource.
     *
     * @param  Tower  $tower
     * @return TowerResource
     * @throws AuthorizationException
     */
    public function show(Tower $tower)
    {
        $this->authorize('show', $tower);

        return new TowerResource($tower);
    }

    /**
     * Update the specified Tower resource in storage.
     *
     * @param UpdateRequest $request
     * @param Tower $tower
     * @return TowerResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Tower $tower)
    {
        $this->authorize('update', $tower);

        $tower = $this->towerRepository->update($tower, $request->all());

        return new TowerResource($tower);
    }

    /**
     * Remove the specified Tower resource from storage.
     *
     * @param Tower $tower
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Tower $tower)
    {
        $this->authorize('destroy', $tower);

        $this->towerRepository->delete($tower);

        return response()->json(null, 204);
    }
}
