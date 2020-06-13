<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItem;
use App\Http\Requests\PaymentItem\DeleteRequest;
use App\Http\Requests\PaymentItem\IndexRequest;
use App\Http\Requests\PaymentItem\UpdateRequest;
use App\Http\Resources\PaymentItemResource;
use App\Http\Resources\PaymentItemResourceCollection;
use App\Repositories\Contracts\PaymentItemRepository;
use Illuminate\Auth\Access\AuthorizationException;

class PaymentItemController extends Controller
{
    /**
     * @var PaymentItemRepository
     */
    protected $paymentItemRepository;

    /**
     * PaymentItemController constructor.
     * @param PaymentItemRepository $paymentItemRepository
     */
    public function __construct(PaymentItemRepository $paymentItemRepository)
    {
        $this->paymentItemRepository = $paymentItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemResourceCollection
     * @throws AuthorizationException
     */
    public function index(IndexRequest $request)
    {
        $this->authorize('list', [PaymentItem::class, $request->input('propertyId'), $request->get('unitId', null), $request->get('userId', null)]);

        $paymentItems = $this->paymentItemRepository->findBy($request->all());

        return new PaymentItemResourceCollection($paymentItems);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItem $paymentItem
     * @return PaymentItemResource
     * @throws AuthorizationException
     */
    public function show(PaymentItem $paymentItem)
    {
        $this->authorize('show', $paymentItem);

        return new PaymentItemResource($paymentItem);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItem $paymentItem
     * @return PaymentItemResource
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, PaymentItem $paymentItem)
    {
        $this->authorize('update', $paymentItem);

        $paymentItem = $this->paymentItemRepository->update($paymentItem, $request->all());

        return new PaymentItemResource($paymentItem);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItem $paymentItem
     * @param DeleteRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(DeleteRequest $request, PaymentItem $paymentItem)
    {
        $this->authorize('destroy', $paymentItem);

        $this->paymentItemRepository->update($paymentItem, ['status' => PaymentItem::STATUS_CANCELLED]);

        return response()->json(null,204);
    }
}
