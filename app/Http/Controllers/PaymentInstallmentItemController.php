<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentInstallmentItem;
use App\Http\Requests\PaymentInstallmentItem\IndexRequest;
use App\Http\Requests\PaymentInstallmentItem\StoreRequest;
use App\Http\Requests\PaymentInstallmentItem\UpdateRequest;
use App\Http\Resources\PaymentInstallmentItemResource;
use App\Http\Resources\PaymentInstallmentItemResourceCollection;
use App\Repositories\Contracts\PaymentInstallmentItemRepository;

class PaymentInstallmentItemController extends Controller
{
    /**
     * @var PaymentInstallmentItemRepository
     */
    protected $paymentInstallmentItemRepository;

    /**
     * PaymentInstallmentController constructor.
     * @param PaymentInstallmentItemRepository $paymentInstallmentItemRepository
     */
    public function __construct(PaymentInstallmentItemRepository $paymentInstallmentItemRepository)
    {
        $this->paymentInstallmentItemRepository = $paymentInstallmentItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentInstallmentItemResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentInstallmentItems = $this->paymentInstallmentItemRepository->findBy($request->all());

        return new PaymentInstallmentItemResourceCollection($paymentInstallmentItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentInstallmentItemResource
     */
    public function store(StoreRequest $request)
    {
        $paymentInstallmentItem = $this->paymentInstallmentItemRepository->save($request->all());

        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return PaymentInstallmentItemResource
     */
    public function show(PaymentInstallmentItem $paymentInstallmentItem)
    {
        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return PaymentInstallmentItemResource
     */
    public function update(UpdateRequest $request, PaymentInstallmentItem $paymentInstallmentItem)
    {
        $paymentInstallmentItem = $this->paymentInstallmentItemRepository->update($paymentInstallmentItem, $request->all());

        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentInstallmentItem $paymentInstallmentItem)
    {
        $this->paymentInstallmentItemRepository->delete($paymentInstallmentItem);

        return response()->json(null, 204);
    }
}
