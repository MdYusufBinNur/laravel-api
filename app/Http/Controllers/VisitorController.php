<?php

namespace App\Http\Controllers;

use App\DbModels\Visitor;
use App\Http\Requests\Visitor\IndexRequest;
use App\Http\Requests\Visitor\StoreRequest;
use App\Http\Requests\Visitor\UpdateRequest;
use App\Http\Resources\VisitorResource;
use App\Http\Resources\VisitorResourceCollection;
use App\Repositories\Contracts\VisitorRepository;
use Illuminate\Auth\Access\AuthorizationException;

class VisitorController extends Controller
{
    /**
     * @var VisitorRepository
     */
    protected $visitorRepository;

    /**
     * VisitorController constructor.
     * @param VisitorRepository $visitorRepository
     */
    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return VisitorResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [Visitor::class, $request->get('propertyId'), $request->get('unitId', null), $request->get('userId', null)]);

        $visitors = $this->visitorRepository->findBy($request->all());

        return new VisitorResourceCollection($visitors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return VisitorResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [Visitor::class, $request->get('propertyId')]);

        $visitor = $this->visitorRepository->save($request->all());

        return new VisitorResource($visitor);
    }

    /**
     * Display the specified resource.
     *
     * @param Visitor $visitor
     * @return VisitorResource
     * @throws AuthorizationException
     */
    public function show(Visitor $visitor)
    {
        $this->authorize('show', $visitor);

        return new VisitorResource($visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Visitor $visitor
     * @return VisitorResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, Visitor $visitor)
    {
        $this->authorize('update', $visitor);

        $visitor = $this->visitorRepository->update($visitor,$request->all());

        return new VisitorResource($visitor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Visitor $visitor
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Visitor $visitor)
    {
        $this->authorize('destroy', $visitor);

        $this->visitorRepository->delete($visitor);

        return response()->json(null,204);
    }
}
