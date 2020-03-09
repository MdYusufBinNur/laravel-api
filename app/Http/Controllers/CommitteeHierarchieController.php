<?php

namespace App\Http\Controllers;

use App\DbModels\CommitteeHierarchie;
use App\Http\Requests\CommitteeHierarchie\IndexRequest;
use App\Http\Requests\CommitteeHierarchie\StoreRequest;
use App\Http\Requests\CommitteeHierarchie\UpdateRequest;
use App\Http\Resources\CommitteeHierarchieResource;
use App\Http\Resources\CommitteeHierarchieResourceCollection;
use App\Repositories\Contracts\CommitteeHierarchieRepository;
use Illuminate\Http\Request;

class CommitteeHierarchieController extends Controller
{
    /**
     * @var CommitteeHierarchieRepository
     */
    protected $committeeHierarchieRepository;

    /**
     * CommitteeHierarchieController constructor.
     * @param CommitteeHierarchieRepository $committeeHierarchieRepository
     */
    public function __construct(CommitteeHierarchieRepository $committeeHierarchieRepository)
    {
        $this->committeeHierarchieRepository = $committeeHierarchieRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return CommitteeHierarchieResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $committeeHierarchies = $this->committeeHierarchieRepository->findBy($request->all());

        return new CommitteeHierarchieResourceCollection($committeeHierarchies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CommitteeHierarchieResource
     */
    public function store(StoreRequest $request)
    {
        $committeeHierarchie = $this->committeeHierarchieRepository->save($request->all());

        return new CommitteeHierarchieResource($committeeHierarchie);
    }

    /**
     * Display the specified resource.
     *
     * @param CommitteeHierarchie $committeeHierarchie
     * @return CommitteeHierarchieResource
     */
    public function show(CommitteeHierarchie $committeeHierarchie)
    {
        return new CommitteeHierarchieResource($committeeHierarchie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param CommitteeHierarchie $committeeHierarchie
     * @return CommitteeHierarchieResource
     */
    public function update(UpdateRequest $request, CommitteeHierarchie $committeeHierarchie)
    {
        $committeeHierarchie = $this->committeeHierarchieRepository->update($committeeHierarchie, $request->all());

        return new CommitteeHierarchieResource($committeeHierarchie);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CommitteeHierarchie $committeeHierarchie
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommitteeHierarchie $committeeHierarchie)
    {
        $this->committeeHierarchieRepository->delete($committeeHierarchie);

        return response()->json(null, 204);
    }
}
