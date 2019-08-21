<?php

namespace App\Mail\EnterpriseUser;

use App\DbModels\EnterpriseUser;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnterpriseUserCreatedMail extends Mailable
{
    use SerializesModels;

    /**
     * @var EnterpriseUser
     */
    public $enterpriseUser;

    /**
     * Create a new message instance.
     *
     * @param EnterpriseUser $enterpriseUser
     * @return void
     */
    public function __construct(EnterpriseUser $enterpriseUser)
    {
        $this->enterpriseUser = $enterpriseUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $enterpriseUser = $this->enterpriseUser;
        $user = $enterpriseUser->user;
        $company = $enterpriseUser->company;

        return $this->subject("Welcome to {$company->title} company")->view('enterprise-user.created')
            ->with(['enterpriseUser' => $enterpriseUser, 'user' => $user, 'company' => $company]);
    }
}
