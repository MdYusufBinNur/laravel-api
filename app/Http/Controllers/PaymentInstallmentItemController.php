<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentInstallmentItem;
use App\Http\Requests\PaymentInstallmentItem\IndexRequest;
use App\Http\Requests\PaymentInstallmentItem\StoreRequest;
use App\Http\Requests\PaymentInstallmentItem\UpdateRequest;
use App\Http\Resources\PaymentInstallmentItemResource;
use App\Http\Resources\PaymentInstallmentItemResourceCollection;
use App\Repositories\Contracts\PaymentInstallmentItemRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

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
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentInstallmentItem::class, $request->get('propertyId')]);

        $paymentInstallmentItems = $this->paymentInstallmentItemRepository->findBy($request->all());

        return new PaymentInstallmentItemResourceCollection($paymentInstallmentItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentInstallmentItemResource
     * @throws AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('store', [PaymentInstallmentItem::class, $request->get('propertyId')]);

        $paymentInstallmentItem = $this->paymentInstallmentItemRepository->save($request->all());

        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return PaymentInstallmentItemResource
     * @throws AuthorizationException
     */
    public function show(PaymentInstallmentItem $paymentInstallmentItem)
    {
        $this->authorize('show', $paymentInstallmentItem);

        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return PaymentInstallmentItemResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentInstallmentItem $paymentInstallmentItem)
    {
        $this->authorize('update', $paymentInstallmentItem);

        $paymentInstallmentItem = $this->paymentInstallmentItemRepository->update($paymentInstallmentItem, $request->all());

        return new PaymentInstallmentItemResource($paymentInstallmentItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentInstallmentItem $paymentInstallmentItem
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(PaymentInstallmentItem $paymentInstallmentItem)
    {
        $this->authorize('destroy', $paymentInstallmentItem);

        $this->paymentInstallmentItemRepository->delete($paymentInstallmentItem);

        return response()->json(null, 204);
    }
}
