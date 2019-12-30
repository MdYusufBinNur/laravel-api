<?php

namespace App\Http\Controllers;

use App\DbModels\PaymentPublishLog;
use App\Http\Requests\PaymentPublishLog\IndexRequest;
use App\Http\Requests\PaymentPublishLog\StoreRequest;
use App\Http\Requests\PaymentPublishLog\UpdateRequest;
use App\Http\Resources\PaymentPublishLogResource;
use App\Http\Resources\PaymentPublishLogResourceCollection;
use App\Repositories\Contracts\PaymentPublishLogRepository;

class PaymentPublishLogController extends Controller
{
    /**
     * @var PaymentPublishLogRepository
     */
    protected $paymentPublishLogRepository;

    /**
     * PaymentPublishLogController constructor.
     * @param PaymentPublishLogRepository $paymentPublishLogRepository
     */
    public function __construct(PaymentPublishLogRepository $paymentPublishLogRepository)
    {
        $this->paymentPublishLogRepository = $paymentPublishLogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return PaymentPublishLogResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $paymentPublishLogs = $this->paymentPublishLogRepository->findBy($request->all());

        return new PaymentPublishLogResourceCollection($paymentPublishLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return PaymentPublishLogResource
     */
    public function store(StoreRequest $request)
    {
        $paymentPublishLog = $this->paymentPublishLogRepository->save($request->all());

        return new PaymentPublishLogResource($paymentPublishLog);
    }

    /**
     * Display the specified resource.
     *
     * @param PaymentPublishLog $paymentPublishLog
     * @return PaymentPublishLogResource
     */
    public function show(PaymentPublishLog $paymentPublishLog)
    {
        return new PaymentPublishLogResource($paymentPublishLog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return PaymentPublishLogResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $paymentPublishLog = $this->paymentPublishLogRepository->update($paymentPublishLog, $request->all());

        return new PaymentPublishLogResource($paymentPublishLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PaymentPublishLog $paymentPublishLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentPublishLog $paymentPublishLog)
    {
        $this->paymentPublishLogRepository->delete($paymentPublishLog);

        return response()->json(null, 204);
    }
}
