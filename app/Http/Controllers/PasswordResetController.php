<?php

namespace App\Http\Controllers;

use App\DbModels\PasswordReset;
use App\Http\Requests\PasswordReset\StoreRequest;
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
     * @param  StoreRequest  $request
     * @return PasswordResetResource
     */
    public function store(StoreRequest $request)
    {
        $passwordReset = $this->passwordResetRepository->save($request->all());

        return new PasswordResetResource($passwordReset);
    }

    /**
     * Display the specified resource.
     *
     * @param $token
     * @return PasswordResetResource
     */
    public function show($token)
    {
        $passwordReset = $this->passwordResetRepository->findOneBy(['token' => $token]);

        if (!$passwordReset instanceof PasswordReset) {
            return response()->json(['status' => 404, 'message' => 'Resource not found with the specific id.'], 404);
        }

        return new PasswordResetResource($passwordReset);
    }
}
