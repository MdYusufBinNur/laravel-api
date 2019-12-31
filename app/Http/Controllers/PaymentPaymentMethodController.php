<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentPaymentMethod;
use App\Http\Requests\PaymentPaymentMethod\IndexRequest;
use App\Http\Requests\PaymentPaymentMethod\StoreRequest;
use App\Http\Requests\PaymentPaymentMethod\UpdateRequest;
use App\Http\Resources\PaymentPaymentMethodResource;
use App\Http\Resources\PaymentPaymentMethodResourceCollection;
use App\Repositories\Contracts\PaymentPaymentMethodRepository;
use Illuminate\Http\Request;

class PaymentPaymentMethodController extends Controller
{
    /**
     * @var PaymentPaymentMethodRepository
     */
    protected $paymentPaymentMethodRepository;

    /**
     * PaymentPaymentMethodController constructor.
     * @param PaymentPaymentMethodRepository $paymentPaymentMethodRepository
     */
    public function __construct(PaymentPaymentMethodRepository $paymentPaymentMethodRepository)
    {
        $this->paymentPaymentMethodRepository = $paymentPaymentMethodRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentPaymentMethodResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentPaymentMethods = $this->paymentPaymentMethodRepository->findBy($request->all());

        return new PaymentPaymentMethodResourceCollection($paymentPaymentMethods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentPaymentMethodResource
     */
    public function store(StoreRequest $request)
    {
        $paymentPaymentMethod = $this->paymentPaymentMethodRepository->save($request->all());

        return new PaymentPaymentMethodResource($paymentPaymentMethod);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentPaymentMethod $paymentPaymentMethod
     * @return PaymentPaymentMethodResource
     */
    public function show(PaymentPaymentMethod $paymentPaymentMethod)
    {
        return new PaymentPaymentMethodResource($paymentPaymentMethod);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentPaymentMethod $paymentPaymentMethod
     * @return PaymentPaymentMethodResource
     */
    public function update(UpdateRequest $request, PaymentPaymentMethod $paymentPaymentMethod)
    {
        $paymentPaymentMethod = $this->paymentPaymentMethodRepository->update($paymentPaymentMethod, $request->all());

        return new PaymentPaymentMethodResource($paymentPaymentMethod);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentPaymentMethod $paymentPaymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentPaymentMethod $paymentPaymentMethod)
    {
        $this->paymentPaymentMethodRepository->delete($paymentPaymentMethod);

        return response()->json(null, 204);
    }
}
