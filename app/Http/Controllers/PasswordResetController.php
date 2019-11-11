<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordReset\GenerateTokenRequest;
use App\Http\Requests\PasswordReset\PasswordResetRequest;
use App\Http\Requests\Request;
use App\Http\Resources\PasswordResetResource;
use App\Repositories\Contracts\PasswordResetRepository;

class PasswordResetController extends Controller
{
    /**
     * @var PasswordResetRepository
     */
    protected $passwordResetRepository;

    /**
     * PasswordResetController constructor.
     * @param PasswordResetRepository $passwordResetRepository
     */
    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  GenerateTokenRequest  $request
     * @return PasswordResetResource
     */
    public function generateResetToken(GenerateTokenRequest $request)
    {
        $passwordReset = $this->passwordResetRepository->save($request->all());

        return new PasswordResetResource($passwordReset);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $token
     * @return PasswordResetResource
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        $this->passwordResetRepository->resetPassword($request->all());

        return response()->json(['status' => 201, 'message' => 'Password has been reset'], 201);
    }
}
