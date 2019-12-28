<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentType;
use App\Http\Requests\PaymentType\IndexRequest;
use App\Http\Requests\PaymentType\StoreRequest;
use App\Http\Requests\PaymentType\UpdateRequest;
use App\Http\Resources\PaymentTypeResource;
use App\Http\Resources\PaymentTypeResourceCollection;
use App\Repositories\Contracts\PaymentTypeRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentTypeController extends Controller
{
    /**
     * @var PaymentTypeRepository
     */
    protected $paymentTypeRepository;

    /**
     * PaymentTypeController constructor.
     * @param PaymentTypeRepository $paymentTypeRepository
     */
    public function __construct(PaymentTypeRepository $paymentTypeRepository)
    {
        $this->paymentTypeRepository = $paymentTypeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentTypeResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentType::class, $request->propertyId]);

        $paymentTypes = $this->paymentTypeRepository->findBy($request->all());

        return new PaymentTypeResourceCollection($paymentTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return PaymentTypeResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PaymentType::class, $request->propertyId]);

        $paymentType = $this->paymentTypeRepository->save($request->all());

        return new PaymentTypeResource($paymentType);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentType $paymentType
     * @return PaymentTypeResource
     * @throws AuthorizationException
     */
    public function show(PaymentType $paymentType)
    {
        $this->authorize('show', $paymentType);

        return new PaymentTypeResource($paymentType);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentType $paymentType
     * @return PaymentTypeResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentType $paymentType)
    {
        $this->authorize('update', $paymentType);

        $paymentType = $this->paymentTypeRepository->update($paymentType, $request->all());

        return new PaymentTypeResource($paymentType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentType $paymentType
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(PaymentType $paymentType)
    {
        $this->authorize('destroy', $paymentType);

        $this->paymentTypeRepository->delete($paymentType);

        return response()->json(null, 204);
    }
}
