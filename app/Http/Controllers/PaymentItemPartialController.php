<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItemPartial;
use App\Http\Requests\PaymentItemPartial\IndexRequest;
use App\Http\Requests\PaymentItemPartial\StoreRequest;
use App\Http\Requests\PaymentItemPartial\UpdateRequest;
use App\Http\Resources\PaymentItemPartialResource;
use App\Http\Resources\PaymentItemPartialResourceCollection;
use App\Repositories\Contracts\PaymentItemPartialRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentItemPartialController extends Controller
{
    /**
     * @var PaymentItemPartialRepository
     */
    protected $paymentItemPartialRepository;

    /**
     * PaymentItemPartialController constructor.
     * @param PaymentItemPartialRepository $paymentItemPartialRepository
     */
    public function __construct(PaymentItemPartialRepository $paymentItemPartialRepository)
    {
        $this->paymentItemPartialRepository = $paymentItemPartialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemPartialResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentItemPartial::class, $request->input('propertyId')]);

        $paymentItemPartials = $this->paymentItemPartialRepository->findBy($request->all());

        return new PaymentItemPartialResourceCollection($paymentItemPartials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return PaymentItemPartialResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PaymentItemPartial::class, $request->input('propertyId'), $request->input('paymentItemId')]);

        $paymentItemPartial = $this->paymentItemPartialRepository->save($request->all());

        return new PaymentItemPartialResource($paymentItemPartial);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItemPartial $paymentItemPartial
     * @return PaymentItemPartialResource
     * @throws AuthorizationException
     */
    public function show(PaymentItemPartial $paymentItemPartial)
    {
        $this->authorize('show', $paymentItemPartial);

        return new PaymentItemPartialResource($paymentItemPartial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItemPartial $paymentItemPartial
     * @return PaymentItemPartialResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentItemPartial $paymentItemPartial)
    {
        $this->authorize('update', $paymentItemPartial);

        $paymentItemPartial = $this->paymentItemPartialRepository->update($paymentItemPartial, $request->all());

        return new PaymentItemPartialResource($paymentItemPartial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItemPartial $paymentItemPartial
     * @return \Illuminate\Http\Response
     * @throws AuthorizationException
     */
    public function destroy(PaymentItemPartial $paymentItemPartial)
    {
        $this->authorize('destroy', $paymentItemPartial);

        $this->paymentItemPartialRepository->delete($paymentItemPartial);

        return response()->json(null, 204);
    }
}
