<?php

namespace App\Mail\Manager;

use App\DbModels\Manager;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManagerCreatedMail extends Mailable
{
    use SerializesModels;

    /**
     * @var Manager
     */
    public $manager;

    /**
     * Create a new message instance.
     *
     * @param Manager $manager
     * @return void
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $manager = $this->manager;
        $user = $manager->user;
        $property = $manager->property;

        return $this->subject("Welcome to {$property->title} community")->view('staff.created')
            ->with(['staff' => $manager, 'user' => $user]);
    }
}
