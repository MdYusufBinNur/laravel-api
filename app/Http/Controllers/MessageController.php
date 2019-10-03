<?php

namespace App\Http\Controllers;

use App\DbModels\Message;
use App\Http\Requests\Message\IndexRequest;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Requests\Message\UpdateRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageResourceCollection;
use App\Repositories\Contracts\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $messageRepository;

    /**
     * MessageController constructor.
     * @param MessageRepository $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MessageResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $messages = $this->messageRepository->findBy($request->all());

        return new MessageResourceCollection($messages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MessageResource
     */
    public function store(StoreRequest $request)
    {
        $message = $this->messageRepository->saveMessage($request->all());

        return $message ? new MessageResource($message) : null;
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return MessageResource
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Message $message
     * @return MessageResource
     */
    public function update(UpdateRequest $request, Message $message)
    {
        $message = $this->messageRepository->update($message, $request->all());

        return new MessageResource($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return void
     */
    public function destroy(Message $message)
    {
        $this->messageRepository->delete($message);

        return response()->json(null, 204);
    }
}
