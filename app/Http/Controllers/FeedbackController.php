<?php

namespace App\Http\Controllers;

use App\DbModels\Feedback;
use App\Http\Requests\Feedback\IndexRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Requests\Feedback\UpdateRequest;
use App\Http\Resources\FeedbackResource;
use App\Http\Resources\FeedbackResourceCollection;
use App\Repositories\Contracts\FeedbackRepository;

class FeedbackController extends Controller
{
    /**
     * @var FeedbackRepository
     */
    protected $feedbackRepository;

    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return FeedbackResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $feedbacks = $this->feedbackRepository->findBy($request->all());

        return new FeedbackResourceCollection($feedbacks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return FeedbackResource
     */
    public function store(StoreRequest $request)
    {
        $feedback = $this->feedbackRepository->save($request->all());

        return new FeedbackResource($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return FeedbackResource
     */
    public function show(Feedback $feedback)
    {
        return new FeedbackResource($feedback);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Feedback $feedback
     * @return FeedbackResource
     */
    public function update(UpdateRequest $request, Feedback $feedback)
    {
        $feedback = $this->feedbackRepository->update($feedback, $request->all());

        return new FeedbackResource($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return void
     */
    public function destroy(Feedback $feedback)
    {
        $this->feedbackRepository->delete($feedback);

        return response()->json(null, 204);
    }
}
