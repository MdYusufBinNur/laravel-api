<?php

namespace App\Http\Controllers;

use App\DbModels\Vendor;
use App\Http\Requests\Vendor\IndexRequest;
use App\Http\Requests\Vendor\StoreRequest;
use App\Http\Requests\Vendor\UpdateRequest;
use App\Http\Resources\VendorResource;
use App\Http\Resources\VendorResourceCollection;
use App\Repositories\Contracts\VendorRepository;

class VendorController extends Controller
{
    /**
     * @var VendorRepository
     */
    protected $vendorRepository;

    /**
     * VendorController constructor.
     * @param VendorRepository $vendorRepository
     */
    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return VendorResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $vendors = $this->vendorRepository->findBy($request->all());

        return new VendorResourceCollection($vendors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VendorResource
     */
    public function store(StoreRequest $request)
    {
        $vendor = $this->vendorRepository->save($request->all());

        return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param Vendor $vendor
     * @return VendorResource
     */
    public function show(Vendor $vendor)
    {
        return new VendorResource($vendor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Vendor $vendor
     * @return VendorResource
     */
    public function update(UpdateRequest $request, Vendor $vendor)
    {
        $vendor = $this->vendorRepository->update($vendor, $request->all());

        return new VendorResource($vendor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $this->vendorRepository->delete($vendor);

        return response()->json(null, 204);
    }
}
