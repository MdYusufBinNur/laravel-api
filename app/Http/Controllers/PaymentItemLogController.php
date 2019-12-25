<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentItemLog;
use App\Http\Requests\PaymentItemLog\IndexRequest;
use App\Http\Requests\PaymentItemLog\StoreRequest;
use App\Http\Requests\PaymentItemLog\UpdateRequest;
use App\Http\Resources\PaymentItemLogResource;
use App\Http\Resources\PaymentItemLogResourceCollection;
use App\Repositories\Contracts\PaymentItemLogRepository;

class PaymentItemLogController extends Controller
{
    /**
     * @var PaymentItemLogRepository
     */
    protected $paymentItemLogRepository;

    /**
     * PaymentItemLogController constructor.
     * @param PaymentItemLogRepository $paymentItemLogRepository
     */
    public function __construct(PaymentItemLogRepository $paymentItemLogRepository)
    {
        $this->paymentItemLogRepository = $paymentItemLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentItemLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentItemLogs = $this->paymentItemLogRepository->findBy($request->all());

        return new PaymentItemLogResourceCollection($paymentItemLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentItemLogResource
     */
    public function store(StoreRequest $request)
    {
        $paymentItemLog = $this->paymentItemLogRepository->save($request->all());

        return new PaymentItemLogResource($paymentItemLog);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentItemLog $paymentItemLog
     * @return PaymentItemLogResource
     */
    public function show(PaymentItemLog $paymentItemLog)
    {
        return new PaymentItemLogResource($paymentItemLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param PaymentItemLog $paymentItemLog
     * @return PaymentItemLogResource
     */
    public function update(UpdateRequest $request, PaymentItemLog $paymentItemLog)
    {
        $paymentItemLog = $this->paymentItemLogRepository->update($paymentItemLog, $request->all());

        return new PaymentItemLogResource($paymentItemLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentItemLog $paymentItemLog
     * @return void
     */
    public function destroy(PaymentItemLog $paymentItemLog)
    {
        $this->paymentItemLogRepository->delete($paymentItemLog);

        return response()->json(null, 204);
    }
}
