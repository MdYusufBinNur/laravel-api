<?php

namespace App\Http\Controllers;

use App\DbModels\PostMarketplace;
use App\Http\Requests\PostMarketPlace\IndexRequest;
use App\Http\Requests\PostMarketPlace\StoreRequest;
use App\Http\Requests\PostMarketPlace\UpdateRequest;
use App\Http\Resources\PostMarketPlaceResource;
use App\Http\Resources\PostMarketPlaceResourceCollection;
use App\Repositories\Contracts\PostMarketplaceRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PostMarketplaceController extends Controller
{
    /**
     * @var PostMarketplaceRepository
     */
    protected $postMarketplaceRepository;

    /**
     * PostMarketplaceController constructor.
     * @param PostMarketplaceRepository $postMarketplaceRepository
     */
    public function __construct(PostMarketplaceRepository $postMarketplaceRepository)
    {
        $this->postMarketplaceRepository = $postMarketplaceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PostMarketPlaceResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PostMarketplace::class, $request->input('propertyId')]);

        $postMarketplaces = $this->postMarketplaceRepository->findBy($request->all());

        return new PostMarketPlaceResourceCollection($postMarketplaces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PostMarketPlaceResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PostMarketplace::class, $request->get('post')['propertyId']]);

        $postMarketplace = $this->postMarketplaceRepository->save($request->all());

        return new PostMarketPlaceResource($postMarketplace);
    }

    /**
     * Display the specified resource.
     *
     * @param PostMarketplace $postMarketplace
     * @return PostMarketPlaceResource
     * @throws AuthorizationException
     */
    public function show(PostMarketplace $postMarketplace)
    {
        $this->authorize('show', $postMarketplace);

        return new PostMarketPlaceResource($postMarketplace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostMarketplace $postMarketplace
     * @return PostMarketPlaceResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PostMarketplace $postMarketplace)
    {
        $this->authorize('update', $postMarketplace);

        $postMarketplace = $this->postMarketplaceRepository->update($postMarketplace,$request->all());

        return new PostMarketPlaceResource($postMarketplace);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostMarketplace $postMarketplace
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PostMarketplace $postMarketplace)
    {
        $this->authorize('destroy', $postMarketplace);

        $this->postMarketplaceRepository->delete($postMarketplace);

        return response()->json(null, 204);
    }
}
