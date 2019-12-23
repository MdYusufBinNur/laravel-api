<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentRecur;
use App\Http\Requests\PaymentRecur\IndexRequest;
use App\Http\Requests\PaymentRecur\StoreRequest;
use App\Http\Requests\PaymentRecur\UpdateRequest;
use App\Http\Resources\PaymenRecurResource;
use App\Http\Resources\PaymenRecurResourceCollection;
use App\Repositories\Contracts\PaymentRecurRepository;

class PaymentRecurController extends Controller
{
    /**
     * @var PaymentRecurRepository
     */
    protected $paymentRecurRepository;

    /**
     * PaymentRecurController constructor.
     * @param PaymentRecurRepository $paymentRecurRepository
     */
    public function __construct(PaymentRecurRepository $paymentRecurRepository)
    {
        $this->paymentRecurRepository = $paymentRecurRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymenRecurResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentRecurs = $this->paymentRecurRepository->findBy($request->all());

        return new PaymenRecurResourceCollection($paymentRecurs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymenRecurResource
     */
    public function store(StoreRequest $request)
    {
        $paymentRecur = $this->paymentRecurRepository->save($request->all());

        return new PaymenRecurResource($paymentRecur);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentRecur $paymentRecur
     * @return PaymenRecurResource
     */
    public function show(PaymentRecur $paymentRecur)
    {
        return new PaymenRecurResource($paymentRecur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentRecur $paymentRecur
     * @return PaymenRecurResource
     */
    public function update(UpdateRequest $request, PaymentRecur $paymentRecur)
    {
        $paymentRecur = $this->paymentRecurRepository->update($paymentRecur, $request->all());

        return new PaymenRecurResource($paymentRecur);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentRecur $paymentRecur
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentRecur $paymentRecur)
    {
        $this->paymentRecurRepository->delete($paymentRecur);

        return response()->json(null, 204);
    }
}
