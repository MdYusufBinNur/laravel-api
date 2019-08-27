<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordReset\StoreRequest;
use App\Repositories\Contracts\UserRepository;
use http\Message;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * PasswordResetController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return Message
     */
    public function store(StoreRequest $request)
    {
        $this->userRepository->save($request->all());

        return response()->json('Password Updated Successfully', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
