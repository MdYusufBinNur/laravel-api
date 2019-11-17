<?php

namespace App\Listeners\PasswordReset;

use App\Events\PasswordReset\PasswordResetEvent;
use App\Mail\User\ResetUserPassword;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class HandlePasswordResetEvent implements ShouldQueue
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * HandleUserLoggedInEvent constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param PasswordResetEvent $event
     * @return void
     */
    public function handle(PasswordResetEvent $event)
    {
        $passwordReset = $event->passwordReset;

        //send email
        Mail::to($passwordReset->email)->send(new ResetUserPassword($passwordReset));

    }
}
