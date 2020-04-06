<?php

namespace App\Mail\User;

use App\DbModels\PasswordReset;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetUserPassword extends Mailable
{
    use SerializesModels;

    /**
     * @var PasswordReset
     */
    public $passwordReset;

    /**
     * Create a new message instance.
     *
     * @param PasswordReset $passwordReset
     * @return void
     */
    public function __construct(PasswordReset $passwordReset)
    {
        $this->passwordReset = $passwordReset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $passwordReset = $this->passwordReset;

        return $this->subject("Reset your password.")->view('user.password-reset.index')
            ->with(['resetLink' => env('PASSWORD_RESET_LINK_PREFIX') . '/' . $passwordReset->token , 'email' => $passwordReset->email, 'token' => $passwordReset->token, 'created_at' => $passwordReset->created_at, 'user'=> $passwordReset->user]);
    }
}
