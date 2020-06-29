<?php

namespace App\Mail\Fdi;

use App\DbModels\Fdi;
use App\DbModels\User;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthorizedGuestRequestToStaffCreated extends Mailable
{
    use SerializesModels;
    /**
     * @var Fdi
     */
    public $fdi;
    /**
     * @var User
     */
    protected $staffUser;

    /**
     * Create a new message instance.
     *
     * @param User $staffUser
     * @param Fdi $fdi
     */
    public function __construct(User $staffUser, Fdi $fdi)
    {
        $this->fdi = $fdi;
        $this->staffUser = $staffUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fdi = $this->fdi;
        $property = $this->fdi->property;
        $unit = $this->fdi->unit;
        $subject = 'A New Authorized Guest Added from Unit '. $unit->title;
        $propertyLink = $property->getPropertyLink();
        $fdiRequestLink = 'https://'. $propertyLink. '/front-desk-instructions/guest';

        return $this->subject($subject)->view('fdi.index')
            ->with(['staffUser' => $this->staffUser, 'fdi' => $fdi, 'property' => $property, 'unit' => $unit, 'fdiRequestLink' => $fdiRequestLink]);
    }
}
