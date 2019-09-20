<?php

namespace App\Http\Controllers;

use App\DbModels\PostMarketplace;
use App\Http\Requests\PostMarketPlace\IndexRequest;
use App\Http\Requests\PostMarketPlace\StoreRequest;
use App\Http\Requests\PostMarketPlace\UpdateRequest;
use App\Http\Resources\PostMarketPlaceResource;
use App\Http\Resources\PostMarketPlaceResourceCollection;
use App\Repositories\Contracts\PostMarketplaceRepository;

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
     */
    public function index(IndexRequest $request)
    {
        $postMarketplaces = $this->postMarketplaceRepository->findBy($request->all());

        return new PostMarketPlaceResourceCollection($postMarketplaces);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PostMarketPlaceResource
     */
    public function store(StoreRequest $request)
    {
        $postMarketplace = $this->postMarketplaceRepository->save($request->all());

        return new PostMarketPlaceResource($postMarketplace);
    }

    /**
     * Display the specified resource.
     *
     * @param PostMarketplace $postMarketplace
     * @return PostMarketPlaceResource
     */
    public function show(PostMarketplace $postMarketplace)
    {
        return new PostMarketPlaceResource($postMarketplace);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PostMarketplace $postMarketplace
     * @return PostMarketPlaceResource
     */
    public function update(UpdateRequest $request, PostMarketplace $postMarketplace)
    {
        $postMarketplace = $this->postMarketplaceRepository->update($postMarketplace,$request->all());

        return new PostMarketPlaceResource($postMarketplace);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PostMarketplace $postMarketplace
     * @return void
     */
    public function destroy(PostMarketplace $postMarketplace)
    {
        $this->postMarketplaceRepository->delete($postMarketplace);

        return response()->json(null, 204);
    }
}
