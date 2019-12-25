<?php

namespace App\Http\Controllers;

use App\DbModels\PasswordReset;
use App\Http\Requests\PasswordReset\GenerateTokenRequest;
use App\Http\Requests\PasswordReset\PasswordResetRequest;
use App\Http\Requests\Request;
use App\Http\Resources\PasswordResetResource;
use App\Http\Resources\UserResource;
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
     * @return UserResource
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        $passwordReset = $this->passwordResetRepository->findOneBy(['token' => $request->get('token')]);

        if (!$passwordReset instanceof PasswordReset) {
            return response()->json(['status' => 404, 'message' => 'Token is invalid.'], 404);
        }

        $user = $this->passwordResetRepository->resetPassword($passwordReset, $request->all());

        return response()->json(['status' => 201, 'message' => 'Password has been reset.', 'user' => new UserResource($user)], 201);

    }
}
