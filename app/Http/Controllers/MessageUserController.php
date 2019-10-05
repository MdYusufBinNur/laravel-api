<?php

namespace App\Http\Controllers;

use App\DbModels\MessageUser;
use App\Http\Requests\MessageUser\BulkUpdateReadStatusRequest;
use App\Http\Requests\MessageUser\IndexRequest;
use App\Http\Requests\MessageUser\StoreRequest;
use App\Http\Requests\MessageUser\UpdateRequest;
use App\Http\Resources\MessageUserResource;
use App\Http\Resources\MessageUserResourceCollection;
use App\Repositories\Contracts\MessageUserRepository;
use Illuminate\Http\Request;

class MessageUserController extends Controller
{
    /**
     * @var MessageUserRepository
     */
    protected $messageUserRepository;

    /**
     * MessageUserController constructor.
     * @param MessageUserRepository $messageUserRepository
     */
    public function __construct(MessageUserRepository $messageUserRepository)
    {
        $this->messageUserRepository = $messageUserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return MessageUserResourceCollection
     */
    public function index(IndexRequest $request)
    {
        $messageUsers = $this->messageUserRepository->findBy($request->all());

        return new MessageUserResourceCollection($messageUsers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MessageUserResource
     */
    public function store(StoreRequest $request)
    {
        $messageUser = $this->messageUserRepository->save($request->all());

        return new MessageUserResource($messageUser);
    }

    /**
     * Display the specified resource.
     *
     * @param MessageUser $messageUser
     * @return MessageUserResource
     */
    public function show(MessageUser $messageUser)
    {
        return new MessageUserResource($messageUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param MessageUser $messageUser
     * @return MessageUserResource
     */
    public function update(UpdateRequest $request, MessageUser $messageUser)
    {
        $messageUser = $this->messageUserRepository->update($messageUser, $request->all());

        return new MessageUserResource($messageUser);
    }

    /**
     * Bulk update the specified resource in storage.
     *
     * @param BulkUpdateReadStatusRequest $request
     * @return MessageUserResource
     */
    public function bulkUpdate(BulkUpdateReadStatusRequest $request)
    {
        $messageUsers = $this->messageUserRepository->bulkUpdateReadStatus($request->all());

        return  new MessageUserResourceCollection($messageUsers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MessageUser $messageUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(MessageUser $messageUser)
    {
        $this->messageUserRepository->delete($messageUser);

        return response()->json(null, 204);
    }
}
